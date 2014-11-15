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
include_once _PATH . "models/topicsent.class.php";

class TopicController extends AjaxController{
    private $topic;
    private $categories;
    private $topic_sent;
    function TopicController(){
        $this->topic = new TopicModel();
        $this->categories = new CategoriesModel();
        $this->topic_sent = new TopicSentModel();
    }
    function gettopic($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $tables = array(); $result = array();
            $result['table'] = $this->topic->getTableInfo();
            $result['topic'] = $this->topic->getTopicCategory('all');
            $result['category'] = $this->categories->getList();
            return $this->reply($result);
        }
    }
    function addtopic($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $date = jdate('Y/m/j','','','','en');
            $time = jdate('H:i:s','','','','en');
            $topicNumber = $this->oneReply($this->topic->getLastTopicID()) + 10;
            return $this->reply($this->topic->insert(array($arg['cat_id'],$topicNumber,$arg['desc'],$date,$time)));
        }
    }
    function deletetopic($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            return $this->reply($this->topic->delete($arg['id']));
        }
    }
    function gettopicbycat($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $result['table'] = $this->topic->getTableInfo();
            $result['topic'] = $this->topic->getTopicCategory($arg['cid']);
            return $this->reply($result);
        }
    }
    function getsenttopics(){
        $result['data'] = $this->topic_sent->getSentTopics();
        $arr['schema'] = array(
            'topic_number','description','gen_date','gen_time','sent_date','sent_time','category_name','mo_keyword','sender'
        );
        $arr['lables'] = array(
            'شماره تاپیک','توضیحات','تاریخ درج','ساعت درج','تاریخ ارسال','ساعت ارسال','تالار','کلمه کلیدی','ارسال کننده'
        );
        $arr['cols'] = array(
            'topic_number','description','gen_date','gen_time','sent_date','sent_time','category_name','mo_keyword','sender'
        );
        $result['table'] = $this->topic_sent->getTableInfoShow($arr['schema'],$arr['lables'],$arr['cols']);
        return $this->reply($result);
    }
    function senttopic($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $date = jdate('Y/m/j','','','','en');
            $time = jdate('H:i:s','','','','en');
            return $this->reply($this->topic_sent->insert(array($arg['tid'],$_SESSION['CID'],$date,$time)));
        }
    }
    function searchtopic($arg){
        if ($_SESSION['ACL']->checkPermission($_SESSION['CID'], 'forum', 'full')){
            $result['data'] = $this->topic->getTopicBySearch($arg['startS'],$arg['finishS'],$arg['startD'],$arg['finishD']);
            $result['table'] = $this->topic->getTableInfo();
            return $this->reply($result);
        }
    }
}