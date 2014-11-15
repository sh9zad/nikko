<?php
/**
 * Created by PhpStorm.
 * User: hossein.sajjadi
 * Date: 11/2/14
 * Time: 3:16 PM
 */

include_once _PATH . 'base/model.class.php';

class TopicModel extends Model
{
    function TopicModel()
    {
        parent::Model('topic');

        $this->cols = array(
            "id", "category_id","topic_number", "description", "gen_date", "gen_time"
        );

        $this->labels = array(
            "0", "0","Topic Number", "Description", "Generate Date", "Generate Time"
        );

        $this->schema = array(
            "0", "0","num","txt","txt","txt"
        );

        $this->ids = array(
            "0","0", "txt-topic-number", "txt-description","txt-gendate","txt-gentime"
        );

        $this->control = 'topic';
    }
    function getTopicCategory($cid){
        $query = "SELECT `topic`.*,`categories`.category_name,`categories`.mo_keyword from `topic`
              LEFT JOIN `categories` ON `categories`.id = `topic`.category_id";
        if($cid != 'all'){
            $query .= " WHERE `topic`.category_id = $cid";
            //print($query);
        }
        return $this->search($query);
    }
    function getLastTopicID(){
        $query = "SELECT * FROM `$this->tablename` ORDER BY id DESC LIMIT 1;";
        return $this->search($query,array('id'));
    }
}