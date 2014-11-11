<?php
/**
 * Created by PhpStorm.
 * User: hossein.sajjadi
 * Date: 11/2/2014
 * Time: 09:46 AM
 */

include_once _PATH . 'base/model.class.php';

class CategoriesModel extends Model
{
    function CategoriesModel()
    {
        parent::Model('categories');

        $this->cols = array(
            "id", "category_name","mo_keyword"
        );

        $this->labels = array(
            "0", "Category Name", "MO Keyword"
        );

        $this->schema = array(
            "0", "txt","txt"
        );

        $this->ids = array(
            "0", "txt-category-name", "txt-mokeyword"
        );
        $this->control = 'cat';
    }
/*    function lastCtegoryID($cat_id){
        $query = "SELECT `$this->tablename`.id from `$this->tablename` WHERE `$this->tablename`.id = $cat_id";
        return $this->search(array('id'));
    }
*/
}