<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Settings;
use View;
use Mail;

class FrontController extends Controller {

    public $settings = [];

    public function __construct() {

        $this->fetchSiteSettings();
    }

    public function SendMail($data) {
        
        $view = view('mail')->render();
        $email_msg = str_replace("[[CONTENT]]", $data['data']['content'], $view);
     
        $email = [
            'to' => $data['to'],
            'subject' => $data['subject'],
            'data' => $email_msg, //view file to render
            'support_name' => get_settings('Support', 'support_name'),
            'support_email' => get_settings('Support', 'support_email'),
        ];

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $email['support_name'] . " <" . $email['support_email'] . ">" . "\r\n";

        mail($email['to'], $email['subject'], $email['data'], $headers);

       
//        Mail::send('mail', $email['data'], function($message)use ($email) {
//            $message->to($email['to'], '')
//                    ->subject($email['subject']);
//            $message->from($email['support_email'], $email['support_name']);
//        });
    }

    public function fetchSiteSettings() {
        foreach (Settings::all() as $setting) {
            $this->settings[strtolower(str_replace(" ", "_", $setting->module))][$setting->slug] = $setting->value;
        }
    }

}
