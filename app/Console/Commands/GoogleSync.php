<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use App\Model\UserMaster;
use App\Model\BatchMaster;
use App\Model\BatchDays;
use App\Model\BatchEvent;
use App\Model\BatchStudent;
use App\Model\AttendenceType;

class GoogleSync extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'googlesync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Users google calender sync.';
    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

        $client = new Google_Client();
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setAuthConfig('client_secret.json');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $guzzleClient = new \GuzzleHttp\Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);
        $this->client = $client;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $sync_batch = \App\Model\SyncSchedule::where('status', '1')->get()->first();
        if (count($sync_batch) > 0) {
            $batch_master_id = $sync_batch->batch_master_id;
            $batch_master = \App\Model\BatchMaster::where('id', $batch_master_id)->get()->first();
            $users = [];
            $teachers = [];

            if ($sync_batch->process_type == 'all') {
                $students = \App\Model\BatchStudent::where('batch_master_id', $batch_master_id)->where('status', '1')->get()->all();

                foreach ($students as $student) {
                    $std_row = \App\Model\Student::where('id', $student->student_id)->get()->first();
                    if (count($std_row) == 1) {
                        if (!in_array($std_row->user_master_id, $users)) {
                            array_push($users, $std_row->user_master_id);
                        }
                    }
                }
            }

            $batch_events = \App\Model\BatchEvent::where('batch_master_id', $batch_master_id)->where('status', '1')->groupBy('teacher_id')->get()->all();
            foreach ($batch_events as $row) {
                array_push($teachers, $row->teacher_id);
            }

            if (count($users) > 0) {
                foreach ($users as $user) {

                    $user_master = UserMaster::where('id', $user)->where('status', '1')->get()->first();
                    if (count($user_master) == 1) {
                        if ($user_master->google_auth_token != NULL) {
                            $refreshToken = $user_master->google_auth_token;
                            if (!empty($refreshToken)) {
                                $this->client->refreshToken($refreshToken);
                                $accessToken = $this->client->getAccessToken();
                                $accessToken = json_encode($accessToken);
                            }
                            if (isset($accessToken) && $accessToken) {

                                $this->client->setAccessToken($accessToken);
                                $service = new Google_Service_Calendar($this->client);

                                $calendarId = 'primary';
                                $timezone = $service->calendars->get($calendarId)->getTimezone();
                                date_default_timezone_set($timezone);

                                $batch_id = $batch_master_id;
                                $batch_event_ar = [];
                                $batch = BatchMaster::where('id', $batch_master_id)->where('status', '1')->get()->first();

                                $date = strtotime("+1 day", strtotime($batch->end_date));
                                $next_day = date('Y-m-d', $date);

                                $date = strtotime("-1 day", strtotime($batch->start_date));
                                $prev_day = date('Y-m-d', $date);

                                $optParams = array(
                                    'orderBy' => 'startTime',
                                    'q' => $batch->batch_id,
                                    'singleEvents' => TRUE,
                                    'timeMin' => google_date(strtotime($prev_day)),
                                    'timeMax' => google_date(strtotime($next_day)),
                                );
                                $results = $service->events->listEvents($calendarId, $optParams);
                                foreach ($results->getItems() as $row) {
                                    $service->events->delete('primary', $row->id);
                                }


                                $batch_events = BatchEvent::where('batch_master_id', $batch_master_id)->where('status', '1')->get()->all();

                                $instrument = \App\Model\Instrument::where('id', $batch->instrument_id)->where('status', '1')->get()->first();
                                $instrument_name = $instrument->name;

                                foreach ($batch_events as $key => $row) {
                                    $studio_room = \App\Model\StudioRoom::where('id', $row->studio_room_id)->where('status', '1')->get()->first();
                                    $studio = \App\Model\StudioMaster::where('id', $studio_room->studio_master_id)->where('status', '1')->get()->first();
                                    $address = $studio->address . PHP_EOL;
                                    $address .= " Room Name- " . $studio_room->name;

                                    $start_date = google_date(strtotime($row->date . ' ' . $row->start_time));
                                    $end_date = google_date(strtotime($row->date . ' ' . $row->end_time));
                                    $batch_event_ar = [];

                                    if ($batch->batch_type == "public") {
                                        $batch_event_ar['summary'] = $batch->batch_name . "-" . $batch->batch_id;
                                    } else {
                                        $batch_event_ar['summary'] = "Morgan Music Class -" . $batch->batch_id;
                                    }
                                    $batch_event_ar['description'] = 'Class schedule for ' . $instrument_name . " at " . $address;
                                    $batch_event_ar['anyoneCanAddSelf'] = 'Infoway-Site-Morgan';

                                    $batch_event_ar['start'] = ['dateTime' => $start_date];
                                    $batch_event_ar['end'] = ['dateTime' => $end_date];
                                    $batch_event_ar['reminders'] = ['useDefault' => true];

                                    $event = new Google_Service_Calendar_Event($batch_event_ar);
                                    $results = $service->events->insert($calendarId, $event);
                                }
                            }
                        }
                    }
                }
            }
            if (count($teachers) > 0) {
                foreach ($teachers as $user) {

                    $user_master = UserMaster::where('id', $user)->where('status', '1')->get()->first();
                    if (count($user_master) == 1) {
                        if ($user_master->google_auth_token != NULL) {
                            $refreshToken = $user_master->google_auth_token;
                            if (!empty($refreshToken)) {
                                $this->client->refreshToken($refreshToken);
                                $accessToken = $this->client->getAccessToken();
                                $accessToken = json_encode($accessToken);
                            }
                            if (isset($accessToken) && $accessToken) {

                                $this->client->setAccessToken($accessToken);
                                $service = new Google_Service_Calendar($this->client);
                                $calendarId = 'primary';

                                $timezone = $service->calendars->get($calendarId)->getTimezone();
                                date_default_timezone_set($timezone);

                                $batch_id = $batch_master_id;
                                $batch_event_ar = [];
                                $batch = BatchMaster::where('id', $batch_master_id)->where('status', '1')->get()->first();

                                $date = strtotime("+1 day", strtotime($batch->end_date));
                                $next_day = date('Y-m-d', $date);

                                $date = strtotime("-1 day", strtotime($batch->start_date));
                                $prev_day = date('Y-m-d', $date);

                                $optParams = array(
                                    'orderBy' => 'startTime',
                                    'q' => $batch->batch_id,
                                    'singleEvents' => TRUE,
                                    'timeMin' => google_date(strtotime($prev_day)),
                                    'timeMax' => google_date(strtotime($next_day)),
                                );
                                $results = $service->events->listEvents($calendarId, $optParams);
                                foreach ($results->getItems() as $row) {
                                    $service->events->delete('primary', $row->id);
                                }


                                $batch_events = BatchEvent::where('batch_master_id', $batch_master_id)->where('status', '1')->get()->all();

                                $instrument = \App\Model\Instrument::where('id', $batch->instrument_id)->where('status', '1')->get()->first();
                                $instrument_name = $instrument->name;

                                foreach ($batch_events as $key => $row) {
                                    $studio_room = \App\Model\StudioRoom::where('id', $row->studio_room_id)->where('status', '1')->get()->first();
                                    $studio = \App\Model\StudioMaster::where('id', $studio_room->studio_master_id)->where('status', '1')->get()->first();
                                    $address = $studio->address . PHP_EOL;
                                    $address .= " Room Name- " . $studio_room->name;

                                    $start_date = google_date(strtotime($row->date . ' ' . $row->start_time));
                                    $end_date = google_date(strtotime($row->date . ' ' . $row->end_time));
                                    $batch_event_ar = [];

                                    if ($batch->batch_type == "public") {
                                        $batch_event_ar['summary'] = $batch->batch_name . "-" . $batch->batch_id;
                                    } else {
                                        $batch_event_ar['summary'] = "Morgan Music Class -" . $batch->batch_id;
                                    }
                                    $batch_event_ar['description'] = 'Class schedule for ' . $instrument_name . " at " . $address;
                                    $batch_event_ar['anyoneCanAddSelf'] = 'Infoway-Site-Morgan';

                                    $batch_event_ar['start'] = ['dateTime' => $start_date];
                                    $batch_event_ar['end'] = ['dateTime' => $end_date];
                                    $batch_event_ar['reminders'] = ['useDefault' => true];

                                    $event = new Google_Service_Calendar_Event($batch_event_ar);
                                    $results = $service->events->insert($calendarId, $event);
                                }
                            }
                        }
                    }
                    $user_master->last_sync_date = date('Y-m-d H:i:s');
                    $user_master->save();
                }
            }

            $sync_batch->status = '4';
            $sync_batch->save();
            $batch_master->teacher_sync_status = '2';
            $batch_master->save();
        }
    }

}
