<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Routing\Route;
use Response;
use App\Model\EmailNotification;
class Controller extends BaseController {

    protected $item_per_page = 10;
    protected $page_title = '';
    protected $_body_class = 'page';
    protected $view_namespace;
    protected $_theme = '';
    //ajax related attributes
    protected $ajax_fail = TRUE;
    protected $ajax_success = FALSE;
    protected $ajax_message = '';
    protected $ajax_error = '';
    protected $ajax_reload = FALSE;
    protected $ajax_errors = [];
    protected $ajax_area = 'front'; //override from admin corresponding area
    public $_days = ['Monday', 'Tuesday', 'Wednesday', 'Thrusday', 'Friday', 'Saturday', 'Sunday'];

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    public $controllerName = '';
    public $actionName = '';

    public function __construct(Route $route) {
        $currentAction = $route->getActionName();
        list($controller, $action) = explode('@', $currentAction);
        $this->controllerName = preg_replace('/.*\\\/', '', $controller);
        $this->actionName = preg_replace('/.*\\\/', '', $action);
        $this->_body_class = 'page';
    }

    public function render($view, array $data = []) {

        $data['_theme'] = $this->_theme;
        //share value to master layout
        $_commom = [
            '__controller' => SiteHelpers::getControllerName(),
            '_page_title' => $this->page_title,
            '_body_class' => $this->_body_class,
        ];
        \View::share($_commom);
        $data = array_merge($data, $this->data);
//        if (Config::get('app.debug')) {
////            Debugbar::addMessage($_commom, 'global variable'); //remove in production
////            Debugbar::addMessage($data, 'View variable'); //remove in production
//            $data2['current_locale'] = App::getLocale();
////            Debugbar::addMessage($data2, 'View variable2'); //remove in production
//        }
        if (\Request::ajax()) {
            return \Response::json($data);
        }
        $this->layout->content = View::make($this->view_namespace . "$view")->with($data);
    }
    
     public static function rand_string($digits) {
        $alphanum = "1234567890AabBcCdDEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
        // generate the random string
        $rand = substr(str_shuffle($alphanum), 0, $digits);
       
        return $rand;
    }

    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = \View::make($this->layout);
        }
    }

    protected function ajaxResponse($data = []) {
        $fixed_data = [
            'is_login' => auth()->guard('admin')->check(),
            'reload' => $this->ajax_reload,
            'area' => $this->ajax_area,
            'message' => $this->ajax_message,
            'fail' => $this->ajax_fail,
            'success' => $this->ajax_success,
            'errors' => $this->ajax_errors,
            'error' => $this->ajax_error,
        ];
        $response = array_merge($fixed_data, $data);
        return Response::json($response);
    }
    
    function get_email_data($code, $replacedata = array()) {
        $email_data = EmailNotification::where('email_code',$code)->first();
       
        $email_msg = "";
        $email_array = array();
        
        $email_msg = $email_data->body;
        $subject = $email_data->subject;
        
        if (!empty($replacedata)) {
            foreach ($replacedata as $key => $value) {

                $email_msg = str_replace("{{" . $key . "}}", $value, $email_msg);
            }
        }
        return array('body' => $email_msg, 'subject' => $subject);
    }

}
