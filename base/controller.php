<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 3/16/14
 * Time: 1:18 PM
 */

/**
 * Class Controller
 * Parent class of all the Controllers in the project. The logic of the project should be handled here.
 * For each main section of the project, we create a separate controller.
 * No interaction with database should be done directly from here. The only way to access the database is through the
 * Models that we add to the instance of the controller.
 */
class Controller {
    protected  $action;/**< String Stores the action requested by  the user. Used for accessing last step of the application.*/

    /**
     * Default constructor.
     * The requested action will be set to Enter.
     */
    function Controller(){
        $this->action = 'enter';
    }

    /**
     * The first point for processing the received request from the client.
     * Based on the action requested, the controller selects and calls the proper method of the class.
     * @param null $action The action requested by the client. Default action (enter) will be selected if none is provided by the user.
     * @param null $arg Values that is required by the action to process. Usually GET or POST is passed to this function.
     */
    function run($action=null, $arg=null){

        $action = ($action == null) ? $this->action : $action;

        if (method_exists($this, $action) && !(substr($action, 0, 1) == '_')){

            $this->action = $action;

            $this->$action($arg);
            //print_r($this->isAdministrator(1));
        }else {
            echo "<h1>Nikko Framework: Page Not Found</h1>".
            "<h2>Controller: ".get_class($this)."</h2>".
            "<h2>Action: ".$action."</h2>".
            "<p>The page or method you requested could not be found.</p>";
        }
    }

    /**
     * If the request, requires a different controller to handle the action, this function will select the proper controller file.
     * @param $controller name of the controller to be called.
     * @param null $data data required by the controller.
     */
    protected function _load_control($controller, $data=null){
        require_once($controller.'.php');
    }

    /**
     * Loading the view after the logics are taken care of.
     * Please make sure that the view files are properly named and the names are properly called here.
     * @param $viewname name of the view to be displayed.
     * @param null $data The data that the view requires for displaying.
     */
    protected function _load_view($viewname,$data=null){
        //$data will be a variable that can be given an associative array of data to pass to our view.
        if(isset($viewname,$data)){
            foreach($data as $name => $value){
                $$name=$value;
            }
        }
        require_once ('views/'.$viewname.'.tmpl.php');
    }

    /**
     * Loads the home view template as a default page.
     */
    protected function home(){
        $this->_load_view('home');
    }
    protected function uploadimage(){
        $this->_load_view('uploadimage');
    }
}