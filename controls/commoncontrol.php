<?php
/**
 * Created by PhpStorm.
 * User: hossein.sajjadi
 * Date: 11/2/14
 * Time: 10:02 AM
 */

if (!isset($_SESSION)) {session_start();}

include_once _PATH . "base/ajaxcontroller.php";
include_once _PATH . "base_controls/acl.class.php";
include_once _PATH . "models/topic.class.php";
include_once _PATH . "models/categories.class.php";

class TopicController extends AjaxController{
    private $topic;
    private $categories;
    function TopicController(){
        $this->topic = new TopicModel();
        $this->categories = new CategoriesModel();
    }
    function gettopic($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $tables = array(); $result = array();
            $result['table'] = $this->topic->getTableInfo();
            $result['topic'] = $this->topic->getTopicCategory();
            $result['category'] = $this->categories->getList();
            return $this->reply($result);
        }
    }
    function addtopic($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $date = jdate('Y/n/j');
            $time = jdate('H:i:s');
            $topicNumber = 'T'.$this->oneReply($this->topic->getLastTopicID()).'C'.$arg['cat_id'];
            return $this->reply($this->topic->insert(array($arg['cat_id'],$topicNumber,$arg['desc'],$date,$time)));
        }
    }
}