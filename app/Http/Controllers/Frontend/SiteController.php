<?php

namespace App\Http\Controllers\Frontend;

use Validator;
use Illuminate\Http\Request;
use Auth;
use Hash;
use URL;
use DB;
use Artisan;
use App\Model\UserMaster;
use App\Model\Location;
use App\Model\Country;
use App\Model\Settings;
use App\Model\PasswordHistory;
use App\Model\Cms;

class SiteController extends FrontController {

    public function google_sync() {
        Artisan::call('googlesync', []);
    }

    public function index() {
        $data = [];
        $data['welcome_image'] = Cms::where(['page_name' => 'Home_Page', 'section_name' => 'welcome_image','status' => '1'])->get()->first();
        $data['welcome_video'] = Cms::where(['page_name' => 'Home_Page', 'section_name' => 'welcome_video','status' => '1'])->get()->first();
        return view('frontend.site.index', $data);
    }
    
    public function featureartist() {
        $data_msg = [];
        return view('frontend.site.featureartist', $data_msg);
    }
    public function artistdetails() {
        $data_msg = [];
        return view('frontend.site.artistdetails', $data_msg);
    }

    public function about_us() {

        return view('frontend.site.about_us');
    }

    public function page($page = '') {
        if ($page == "") {
            abort(404);
        }

        $model = \App\Model\Cms::where('slug', $page)->get()->first();
        if (count($model) == 0) {
            abort(404);
        }
        return view('frontend.site.page', ['model' => $model]);
    }

    public function group_lesson() {
        $data_msg = [];
        $data_msg['group_lesson_main'] = get_cms_by_slug('group_lesson_main');
        $data_msg['lesson'] = get_cms_collection('group_lesson', 'lesson');

        $date = date('Y-m-d');
        $query = "SELECT be.*, bm.batch_name,bm.color,bm.batch_id, um.name as teacher_name, um.image as teacher_image, ins.name as instrument_name, sr.name as room_name, sm.name as studio_name, sm.address as studio_address, bd.day_name as day_name "
                . "FROM `batch_event` as be "
                . "LEFT JOIN `batch_master` as bm ON be.batch_master_id=bm.id "
                . "LEFT JOIN `user_master` as um ON be.teacher_id=um.id "
                . "LEFT JOIN `instrument` as ins ON bm.instrument_id=ins.id "
                . "LEFT JOIN `studio_room` as sr ON be.studio_room_id=sr.id "
                . "LEFT JOIN `studio_master` as sm ON sr.studio_master_id=sm.id "
                . "LEFT JOIN `batch_days` as bd ON be.batch_day_id=bd.id "
                . "WHERE bm.batch_type='public' AND bm.status='1' AND be.status='1' AND be.date > '{$date}' ORDER BY be.day_index, be.date limit 30";
//                . "WHERE bm.batch_type='public' AND bm.status='1' AND be.status='1' AND be.date > '{$date}' ORDER BY FIELD(date, 'MONDAY', 'TUESDAY', 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY') limit 30";

        $data_msg['lessons'] = DB::select(DB::raw($query));
        $data_msg['group_lesson_timetable'] = get_cms_by_slug('group_lesson_term_1_timetable');
        $data_msg['group_lesson_banner'] = get_cms_by_slug('group_lesson_banner_image');
        return view('frontend.site.group_lesson', $data_msg);
    }

    public function get_application_form($name) {
        if (!in_array($name, ['private', 'group'])) {
            return redirect()->route('/');
        }
        $data = [];
        $data['country'] = Country::orderBy('name', 'asc')->get()->all();
        $data['instrument'] = Instrument::where('status', '1')->orderBy('name', 'asc')->get()->all();
        $data['schedule_arr'] = [
            ['id' => 1, 'name' => 'Monday'],
            ['id' => 2, 'name' => 'Tuesday'],
            ['id' => 3, 'name' => 'Wednesday'],
            ['id' => 4, 'name' => 'Thursday'],
            ['id' => 5, 'name' => 'Friday'],
            ['id' => 6, 'name' => 'Sarurday'],
            ['id' => 7, 'name' => 'Sunday']
        ];
        $data['how_did_you_find_us_arr'] = [
            ['id' => 1, 'reason' => 'Sign'],
            ['id' => 2, 'reason' => 'Flyer'],
            ['id' => 3, 'reason' => 'Google/Other search engine'],
            ['id' => 4, 'reason' => 'Facebook'],
            ['id' => 5, 'reason' => 'Friend'],
            ['id' => 6, 'reason' => 'Other']
        ];
        $data['type'] = $name;
        if ($name == 'private') {
            return view('frontend.site.private_application_form', $data);
        } else {
            return view('frontend.site.group_application_form', $data);
        }
    }

    public function post_application_form(Request $request, $name) {

        if ($request->ajax()) {
            $data_msg = [];
            $validation = [
                'student_name' => 'required',
                'student_dob' => 'required',
                'release_permission' => 'required',
                'parent_name' => 'required',
                'email' => 'required|email',
                'contact_number' => 'required|min:9|regex:/^[0-9]+$/',
                'city' => 'min:3',
                'state' => 'min:3',
                'zip_code' => 'min:3|regex:/^[a-zA-Z0-9]+$/',
            ];
            if (!isset($_POST['other_referred_by'])) {
                $validation = array_merge($validation, [
                    'other_referred_by' => 'required'
                ]);
            }
            if (isset($_POST['check_referred_by'])) {
                $validation = array_merge($validation, [
                    'referred_by_name' => 'required',
                    'referred_by_email' => 'required|email'
                ]);
            }
            $schedule_validator = [];
            $message = [
                'student_name.required' => 'Student name field is required.',
                'student_dob.required' => 'Date of birth field is required.',
                'release_permission.required' => 'Please select one of these.',
                'parent_name.required' => 'Parent name field is required.',
                'email.required' => 'Parent email field is required.',
                'contact_number.required' => 'Contact number field is required.',
                'other_referred_by.required' => 'Please select minimum one of these.',
                'referred_by_name.required' => 'Name field is required.',
                'referred_by_email.required' => 'Email field is required.',
            ];
            if ($request->input('lesson_day_time') != "") {
                foreach ($request->input('lesson_day_time') as $key => $val) {
                    $schedule_validator['lesson_day_time.' . $val['day_name'] . '.start_time'] = 'required';
                    $schedule_validator['lesson_day_time.' . $val['day_name'] . '.end_time'] = 'required';
                    $message['lesson_day_time.' . $val['day_name'] . '.start_time.required'] = 'Start Time can not be blank.';
                    $message['lesson_day_time.' . $val['day_name'] . '.end_time.required'] = 'End Time can not be blank.';
                }
            }
            $validation = array_merge($validation, $schedule_validator);
            $validator = Validator::make($request->all(), $validation, $message);
            $validator->after(function($validator) use($request) {
                if ($request->input('start_date') != '') {
                    if ($request->input('start_date') > $request->input('end_date')) {
                        $validator->errors()->add('end_date', 'End date must be grater than start date.');
                    }
                }
                if ($request->input('lesson_day_time') != "") {
                    foreach ($request->input('lesson_day_time') as $key => $val) {
                        if (isset($val['start_time']) && isset($val['end_time'])) {
                            if ($val['start_time'] >= $val['end_time']) {
                                $validator->errors()->add('lesson_day_time.' . $val['day_name'] . '.end_time', 'End time must be grater than start time.');
                            }
                        }
                    }
                }
//                else {
//                    $validator->errors()->add('lesson_day_time', 'You must select atleast one day.');
//                }
            });

            if ($validator->passes()) {
                $application_form = new ApplicationForm;
                $application_form->type = $name;
                $application_form->student_name = $request->input('student_name');
                $application_form->student_dob = db_date_format($request->input('student_dob'));
                $application_form->street_address_line_1 = $request->input('street_address_line_1');
                $application_form->street_address_line_2 = $request->input('street_address_line_2');
                $application_form->city = $request->input('city');
                $application_form->state = $request->input('state');
                $application_form->zip_code = $request->input('zip_code');
                $application_form->country = $request->input('country');
                $application_form->release_permission = $request->input('release_permission');
                $application_form->parent_name = $request->input('parent_name');
                $application_form->email = $request->input('email');
                $application_form->contact_number = $request->input('contact_number');
                $application_form->referred_by_name = $request->input('referred_by_name');
                $application_form->referred_by_email = $request->input('referred_by_email');
                $application_form->status = 1;
                $application_form->created_at = date('Y-m-d H:i:s');
                $application_form->save();
                if (isset($_POST['instrument_id']) && count($_POST['instrument_id']) > 0) {
                    foreach ($_POST['instrument_id'] as $key => $val) {
                        $instruments_for_tuition = new InstrumentsForTuition;
                        $instruments_for_tuition->application_form_id = $application_form->id;
                        $instruments_for_tuition->instrument_id = $val;
                        $instruments_for_tuition->status = 1;
                        $instruments_for_tuition->save();
                    }
                }
                if (isset($_POST['lesson_day_time']) && count($_POST['lesson_day_time']) > 0) {
                    foreach ($_POST['lesson_day_time'] as $key => $val) {
                        $lesson_day_time = new LessonDayTime;
                        $lesson_day_time->application_form_id = $application_form->id;
                        $lesson_day_time->day_name = get_day_name($val['day_name']);
                        $lesson_day_time->start_time = $val['start_time'];
                        $lesson_day_time->end_time = $val['end_time'];
                        $lesson_day_time->status = 1;
                        $lesson_day_time->save();
                    }
                }
                if (isset($_POST['other_referred_by']) && count($_POST['other_referred_by']) > 0) {
                    foreach ($_POST['other_referred_by'] as $key => $val) {
                        $how_did_you_find_us = new HowDidYouFindUs;
                        $how_did_you_find_us->application_form_id = $application_form->id;
                        $how_did_you_find_us->reason = get_reason_details($val);
                        $how_did_you_find_us->status = 1;
                        $how_did_you_find_us->save();
                    }
                }
                $email_setting = $this->get_email_data('submit_application_form', array('STUDENT_NAME' => $application_form->student_name, 'DOB' => db_date_format($application_form->student_dob), 'PARENT_NAME' => $application_form->parent_name, 'EMAIL' => $application_form->email, 'CONTACT_NUMBER' => $application_form->contact_number));
                $data = array('content' => $email_setting['body']);
                $email_data = [
                    'to' => Settings::select('value')->where('slug', 'admin_email')->get()->first()->value,
                    'subject' => 'Morgan Music Academy :: ' . $email_setting['subject'],
                    'data' => $data
                ];
                $this->SendMail($email_data);
                $request->session()->flash('success_msg', 'Application form submitted successfully.');
                $data_msg['type'] = 'success';
                $data_msg['url'] = Route('/');
            } else {
                $messages_ar = [];
                foreach ($validator->errors()->getMessages() as $key => $val) {
                    $messages_ar[str_replace('.', '_', $key)] = $val[0];
                }
                $data_msg['messages'] = $messages_ar;
                $data_msg['type'] = 'warning';
            }
            return response()->json($data_msg);
        }
    }

    public function private_lesson() {
        $data_msg = [];
        $data_msg['private_lesson_main'] = get_cms_by_slug('private_lesson_main');
        $data_msg['private_lesson_banner'] = get_cms_by_slug('private_lesson_banner_image');
        $data_msg['instrument'] = $instrument = Instrument::where('status', '1')->get()->all();
        return view('frontend.site.private_lesson', $data_msg);
    }

    public function how_it_works() {

        return view('frontend.site.how_it_works');
    }

    public function privacy_policy() {

        return view('frontend.site.privacy_policy');
    }

    public function get_contact() {

        return view('frontend.site.contact');
    }

    public function faq() {
        $faqs = \App\Model\Faq::all();
        return view('frontend.site.faq', ['faqs' => $faqs]);
    }

    public function teacher() {
        $instruments = Instrument::where('status', '1')->get()->all();
        $teachers = UserMaster::where('type_id', 2)->where('status', '1')->get()->all();
        return view('frontend.site.teacher', ['teachers' => $teachers, 'instruments' => $instruments]);
    }

    public function cms(Request $request, $slug) {
        $model = Cms::where('slug', $slug)->get()->first();
        if (count($model) == 0) {
            return redirect()->route('/');
        }

        return view('frontend.site.cms', ['model' => $model]);
    }

    public function google_login(Request $request) {
        $data_msg = [];
        $id = $request->input('id');
        if ($id != "") {
            $model_count = UserMaster::where('google_id', $id)->where('register_type', 'social')->where('status', '<>', 1)->get()->count();
            if ($model_count == 0) {

                $data_msg['id'] = $id = $request->input('id');
                $data_msg['email'] = $email = $request->input('email');
                $data_msg['name'] = $name = $request->input('name');
                $data_msg['register_type'] = "social";
                $data_msg['type'] = "success";
                $data_msg['message'] = "Please fill up the information below to complete your registration.";
            } else {
                $data_msg['type'] = "warning";
                $data_msg['message'] = "You are already registered with us.";
            }
        } else {
            $data_msg['type'] = "auth";
            $data_msg['message'] = "Problem with authentication.";
        }

        return response()->json($data_msg);
    }

    public function get_city(Request $request) {
        $country = $request->input('value');
        $city = "<option value=''>City</option>";
        $states = Location::where('type', 'RE')->where('in_location', $country)->orderBy('local_name', 'asc')->get();

        foreach ($states as $row) {
            $citys = Location::where('type', 'CI')->where('in_location', $row->id)->orderBy('local_name', 'asc')->get();
            foreach ($citys as $cityrow) {

                $city .= "<option value='" . $cityrow->id . "'>" . $cityrow->local_name . "</option>";
            }
        }
        return response()->json($city);
    }

    public function user_signup(Request $request) {
        $data_msg = [];
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'required|min:6|max:16',
                    'password_confirmation' => 'required|same:password',
                    'company_name' => 'required',
                    'country' => 'required',
                    'city' => 'required',
        ]);

        $validator->after(function($validator)use ($request) {
            $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', 3)->get();
            if (count($other_user) > 0) {
                $validator->errors()->add('email', 'Email id already in use.');
            }
        });

        if ($validator->passes()) {

            $token = $this->rand_string(16);

            $model = new UserMaster;
            $model->type_id = 2;
            $model->register_type = $request->input('register_type');
            $model->name = $request->input('name');
            $model->email = $request->input('email');
            $model->password = md5($request->input('password'));
            $model->status = 0;
            $model->company_name = $request->input('company_name');
            $model->country = $request->input('country');
            $model->city = $request->input('city');
            $model->created_at = date("Y-m-d H:i:s");
            $model->activation_token = $token;
            if ($request->input('register_type') == "social") {
                $model->google_id = $request->input('google_id');
            }
            if ($model->save()) {
                $url = Route('activate-account', ['id' => $token]);
                $email_setting = $this->get_email_data('registration', array('FULL_NAME' => $request->input('name'), 'UEMAIL' => $request->input('email'), 'CLICKHERE' => $url));
                $data = array('content' => $email_setting['body']);
                $email_data = [
                    'to' => $model->email,
                    'subject' => 'Photostrip ::Registration',
                    'data' => $data
                ];
                $this->SendMail($email_data);
                $data_msg['type'] = "success";
                $data_msg['message'] = "Your account is created successfully. We have send you a activation link in your email address.";
            }
        } else {
            $error_arr = $validator->errors()->getMessages();
            foreach ($error_arr as $key => $val) {
                if (isset($val[0]) && $val[0] != "") {
                    $data_msg['message'][$key] = $val[0];
                }
            }

            $data_msg['type'] = "warning";
        }

        return response()->json($data_msg);
    }

    public function post_contact(Request $request) {
        $data_msg = [];
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'subject' => 'required',
                    'message' => 'required'
        ]);


        if ($validator->passes()) {


            $model = new \App\Model\Contactus();
            $model->name = $request->input('name');
            $model->email = $request->input('email');
            $model->subject = $request->input('subject');
            $model->status = 0;
            $model->message = $request->input('message');

            if ($model->save()) {

                $data_msg['type'] = "success";
                $data_msg['message'] = "Message sent successfully.";
            }
        } else {
            $error_arr = $validator->errors()->getMessages();
            foreach ($error_arr as $key => $val) {
                if (isset($val[0]) && $val[0] != "") {
                    $data_msg['message'][$key] = $val[0];
                }
            }

            $data_msg['type'] = "warning";
        }

        return response()->json($data_msg);
    }

    public function user_login($type, Request $request) {
        $data_msg = [];
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required|min:1'
        ]);
        if ($validator->passes()) {
            if ($type == 'teacher') {
                $login_type = 2;
            } else if ($type == 'guardian') {
                $login_type = 3;
            }

            $model = UserMaster::where('email', $request->email)
                            ->where('status', '<>', '3')
                            ->whereIn('type_id', array($login_type))
                            ->get()->first();

            if (count($model) == 1) {
                if (Hash::check($request->input('password'), $model->password)) {
                    if ($model->status == 0) {
                        $message = "Login Failed!! Your account is not activated yet.";
                        $data_msg['type'] = "warning";
                        $data_msg['message'] = $message;
                    } else if ($model->status = 1) {
                        Auth::guard($type)->login($model);
                        $data_msg['type'] = "success";
                        if ($type == 'teacher') {
                            $data_msg['url'] = URL('teacher');
                        } else if ($type == 'guardian') {
                            $data_msg['url'] = URL('guardian');
                        }
                    }
                } else {
                    $data_msg['type'] = "warning";
                    $data_msg['message'] = 'Login Failed!! Please check your credentials';
                }
            } else {
                $data_msg['type'] = "warning";
                $data_msg['message'] = 'Login Failed!! Please check your credentials';
            }
        } else {

            $error_arr = $validator->errors()->getMessages();
            foreach ($error_arr as $key => $val) {
                if (isset($val[0]) && $val[0] != "") {
                    $data_msg['message'][$type . "_" . $key] = $val[0];
                }
            }
            $data_msg['type'] = "validation";
        }
        return response()->json($data_msg);
    }

    public function activate_account($id) {
        if ($id == "") {
            return redirect()->route('/');
        }
        $model = UserMaster::where('activation_token', $id)->get()->first();

        if (count($model) == 0) {
            return redirect()->route('/');
        }

        $model->activation_token = NULL;
        $model->status = 1;
        $model->save();

        return redirect()->route('/')->with('success_msg', 'Your account is activated. Please login into your account');
    }

    public function forget_password() {
        return view('frontend.site.forgot_password');
    }

    public function forget_password_post(Request $request) {
        $data_msg = [];
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email'
        ]);

        $validator->after(function($validator)use ($request) {

            $other_user = UserMaster::where('email', $request->email)->where('status', 1)->whereIn('type_id', [2, 3, 4])->get()->first();
            if (count($other_user) == 0) {
                $validator->errors()->add('email', 'Email address is incorrect.');
            }
        });
        if ($validator->passes()) {
            $string = $this->rand_string(16);
            $model = UserMaster::select()->where('email', $request->email)->where('status', '1')->whereIn('type_id', [2, 3, 4])->first();
            $model->reset_password_token = $string;
            $model->save();
            $link = Route("reset-password", ['token' => $string]);
            $right_arrow_image = URL::asset('themes/mail/arrow.png');
            $email_setting = $this->get_email_data('forgot_password', array('FULL_NAME' => $model->name, 'SITE_URL' => $link, 'RIGHT_ARROW_IMAGE' => $right_arrow_image));
            $data = array('content' => $email_setting['body']);
            $email_data = [
                'to' => $model->email,
                'subject' => 'Reset Password',
                'data' => $data
            ];
            $this->SendMail($email_data);
            $request->session()->flash('success_msg', 'Your Password recovery link send in your email.');
            $data_msg['url'] = URL('/');
            $data_msg['type'] = 'success';
        } else {

            $error_arr = $validator->errors()->getMessages();
            foreach ($error_arr as $key => $val) {
                if (isset($val[0]) && $val[0] != "") {
                    $data_msg['message']["forgot_" . $key] = $val[0];
                }
            }
            $data_msg['type'] = "validation";
        }
        return response()->json($data_msg);
    }

    public function reset_password($token) {
        if ($token != "") {
            $model = UserMaster::where('reset_password_token', $token)->first();
            if ($model != NULL) {

                return view('frontend.site.reset_password', ['token' => $token]);
            } else {
                return redirect()->route('/');
            }
        } else {
            return redirect()->route('/');
        }
    }

    public function post_reset_password($token, Request $request) {

        $model = UserMaster::where('reset_password_token', $token)->get()->first();
        if ($model != null) {
            $validator = Validator::make($request->all(), [
                        'password' => 'required|min:6|max:16|regex:/^(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
                        'confirm_password' => 'required|same:password',
                            ], [
                        'password.regex' => 'Password must contain at-least 1 capital letter, 1 small letter and 1 number.'
            ]);
            $validator->after(function($validator)use ($request, $model) {
                $other_user = UserMaster::where('id', $model->id)->get()->first();
                $m = PasswordHistory::where('user_master_id', $model->id)->where('password', $request->input('password'))->orderBy('id', 'desc')->limit(4)->get()->count();
                if ($m > 0) {
                    $validator->errors()->add('password', 'You can not use your previous 4 passwords.');
                }
            });

            if ($validator->passes()) {
                $model->password = Hash::make($request->input('password'));
                $model->reset_password_token = NULL;
                $model->save();
                $request->session()->flash('success_msg', 'Your Password Changes Successfully.');
                return redirect()->route('/');
            }
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            return redirect()->route('/');
        }
    }

    public function gift_card() {
        $vouchers = GiftVoucher::where('status', 1)->get()->all();
        return view('frontend.site.gift_card', ['vouchers' => $vouchers]);
    }

    public function post_gift_card(Request $request) {
        $data_msg = [];
        $validator = Validator::make($request->all(), [
                    'sender_name' => 'required',
                    'sender_email' => 'required|email',
                    'sender_phone' => 'required|regex:/^[0-9]+$/',
                    'recipient_name' => 'required',
                    'recipient_email' => 'required|email',
                    'recipient_phone' => 'required|regex:/^[0-9]+$/',
                    'message' => 'required',
                    'gift_card' => 'required'
        ]);
        $validator->after(function($validator) use($request) {
            if ($request->input('sender_email') != "" && $request->input('recipient_email')) {

                if ($request->input('sender_email') == $request->input('recipient_email')) {
                    $validator->errors()->add('recipient_email', 'Sender and receiver email can not be same.');
                }
            }
        });

        if ($validator->passes()) {
            $amount = 0;

            foreach ($request->input('gift_card') as $row) {
                $gift = GiftVoucher::where('id', $row)->get()->first();
                $amount += $gift->total_cost;
            }


            $model = new GiftCardPurchase();
            $model->sender_name = $request->input('sender_name');
            $model->sender_email = $request->input('sender_email');
            $model->sender_phone = $request->input('sender_phone');
            $model->recipient_name = $request->input('recipient_name');
            $model->recipient_email = $request->input('recipient_email');
            $model->recipient_phone = $request->input('recipient_phone');
            $model->message = $request->input('message');
            $model->gift_card = implode(',', $request->input('gift_card'));
            $model->status = 1;
            $model->payment_status = '21';
            $model->pay_amount = $amount;

            $model->save();

            $data_msg['type'] = "success";
            $data_msg['message'] = "Message sent successfully.";
            $data_msg['amount'] = $amount;
            $data_msg['log_id'] = $model->id;
            $data_msg['red_url'] = Route('gift-payment', ['id' => $model->id]);
        } else {
            $error_arr = $validator->errors()->getMessages();
            foreach ($error_arr as $key => $val) {
                if (isset($val[0]) && $val[0] != "") {
                    $data_msg['message'][$key] = $val[0];
                }
            }

            $data_msg['type'] = "warning";
        }

        return response()->json($data_msg);
    }

    public function get_logout() {
        if (Auth::guard('user')->guest()) {
            return redirect()->route('/');
        } else {
            Auth::guard('user')->logout();
            return redirect()->route('/')->with('success_msg', 'You have been successfully logout !!');
        }
    }

}
