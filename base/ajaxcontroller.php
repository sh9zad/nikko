<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 3/16/14
 * Time: 2:32 PM
 */

/**
 * Class AjaxController
 * This is a toned down version of the Controller for the SoA architecture.
 * Since the SoA doesn't have the views for display this function only returns the values in JSON format.
 * The JSON formatted data then should be processed at the client's side.
 */
class AjaxController{

    /**
     * Based on the action received from the client, this method selects the correct function from the
     * list of the functions of the child class. The process of the action, will then be done in that method.
     * @param $action The action requested by the client
     * @param null $arg the array of the arguments required by the action. Usually GET or POST arrays. If the action doesn't require any arguments this can eb leave blank.
     */
    function run($action, $arg=null){
        if (method_exists($this, $action)){
            $this->$action($arg);
        }
        else {
            $this->reply("Controller: ".get_class($this)." Error: "."Invalid function: $action");
        }
    }

    /**
     * This framework uses the JSON format for communicating with the client side codes.
     * This function gets the results and formats them into a JSON format.
     * @param $data string of data or array of data to be converted.
     */
    function reply($data){
        print_r(json_encode($data, JSON_UNESCAPED_UNICODE));
    }
}