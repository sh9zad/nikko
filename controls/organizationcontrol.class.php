<?php
/**
 * Created by PhpStorm.
 * User: sh.hasanzadeh
 * Date: 9/20/14
 * Time: 4:00 PM
 */
if (!isset($_SESSION)) {session_start();}

include_once _PATH . "base/ajaxcontroller.php";
include_once _PATH . "base_controls/acl.class.php";
include_once _PATH . "models/organization.class.php";
include_once _PATH . "base/members.class.php";

class OrganizationController extends AjaxController{
    private $acl;
    private $organization_model;
    private $members;

    function OrganizationController(){
        $this->acl = new ACLController();
        $this->organization_model = new OrganizationModel();
        $this->members = new Members();
    }

    function getlist($arg){
        $result = array();
        $result['table'] = $this->organization_model->getTableInfo();
        $result['select']['members'] = $this->members->getAllUsers();

        $list = array();
        if (!isset($arg['id'])){
            $list = $this->organization_model->getList();
        }

        if (sizeof($list) < 1){
            $result['list'] = 'none';
            if (!isset($arg['for'])) {
                $result['table'] = $this->setTableInfoAddDivision($result['table'], true);
            }
            elseif ($arg['for'] == 'form'){
                $result['table'] = $this->setTableInfoAddDivision($result['table'], true, $arg['for']);
            }
            elseif($arg['for'] == 'tree'){
                $result['table'] = $this->setTableInfoAddDivision($result['table'], true, $arg['for']);
            }
        }
        else{
            $tree = (isset($arg['tree'])) ? $arg['tree'] : false;
            $parent = $this->organization_model->getList($tree)[0];
            $result['select']['divisions'] = $list;
            if (!isset($arg['for'])) {
                $result['table'] = $this->setTableInfoAddDivision($result['table'], false, $parent);
            }
            elseif ($arg['for'] == 'form' || $arg['for'] == 'tree') {
                $result['table'] = $this->setTableInfoAddDivision($result['table'], false, $arg['for']);
            }
        }

        $this->reply($result);
    }

    function adddivision($arg){
        if ($this->acl->checkPermission($_SESSION['CID'], 'organization', 'full|add')) {
            if (isset($arg['from']) && $arg['from'] == 'form') {
                $data = json_decode($arg['data'], true);
                $table_info = $this->organization_model->getTableInfo();
                $insert_array = array();
                foreach($table_info['ids'] as $t_id){
                    if(array_key_exists($t_id . "-" . $arg['from'], $data)){
                        array_push($insert_array, $data[$t_id . "-" . $arg['from']]);
                    }
                }
                if (!array_key_exists('txt-division-parent-'.$arg['from'], $data)){
                    $id = $this->organization_model->insert(array_merge($insert_array, array(null, "0")));
                    if ($id != false) {
                        $this->organization_model->update(array("child_trail" => $id . ","), $id);
                    }
                }
                else{
                    $id = $this->organization_model->insert(array_merge($insert_array, array("0")));

                    if ($id != false) {
                        $this->organization_model->update(array("child_trail" => $this->organization_model->getList($data['txt-division-parent-'.$arg['from']])[0]['child_trail'] . $id . ","), $id);
                    }
                }
            } else {
                if (!isset($arg['parent'])) {
                    $id = $this->organization_model->insert(array($arg['name'], $arg['head'], null, "0"));

                    if ($id != false) {
                        $this->organization_model->update(array("child_trail" => $id . ","), $id);
                    }
                } else {
                    $id = $this->organization_model->insert(array($arg['name'], $arg['head'], $arg['parent'], "0"));

                    if ($id != false) {
                        $this->organization_model->update(array("child_trail" => $this->organization_model->getList($arg['parent'])[0]['child_trail'] . $id . ","), $id);
                    }
                }
            }
        }
        else {
            $id = 'Permission Denied.';
        }
        $this->reply($id);
    }

    function gettree($arg){

        $array = $this->organization_model->getList();

        $refs = array();
        $list = array();
        $array = $this->organization_model->getList();

        $i = 0;
        $list['id'] = 1;
        $list['title'] = "Karyan";

        foreach($array as $data){
            if ($data['id'] == $data['parent_division']){
                $list['root']['id'] = $data['id'];
                $list['root']['title'] = $data['name'];
                $list['root']['head'] = $data['head'];
                $list['root']['child_trail'] = $data['child_trail'];
                unset($array[$i]);
            }
            $i++;
        }

        foreach($array as $data){
            $thisref = &$refs[ $data['id'] ];

            $thisref['id'] = $data['id'];
            $thisref['title'] = $data['name'];
            $thisref['head'] = $data['head'];
            $thisref['child_trail'] = $data['child_trail'];

            if ($data['parent_division'] == 1) {
                $list['root']['children'][] = &$thisref;
            } else {
                $refs[ $data['parent_division'] ]['children'][] = &$thisref;
            }
        }


        $this->reply($list);
    }

    function deletedivision($arg){
        if ($this->acl->checkPermission($_SESSION['CID'], 'organization', "full|delete" )){
            $result = $this->organization_model->deleteDivision($arg['id']);
        }
        else{
            $result = 'false';
        }
       $this->reply($result);
    }

    /* Set Table Info functions */
    private function setTableInfoAddDivision($table_info, $is_root = false, $tree = false){
        if ($is_root == true){
            for($i = 0 ; $i < sizeof($table_info['schema']); $i++){
                if($table_info['cols'][$i] == 'parent_division'){
                    array_splice($table_info['schema'], $i, 1, "0");
                }
            }
        }

        if ($tree === true || $tree === 'tree'){
            $table_info['schema'][array_search("parent_division",$table_info['cols'])] = '0';
        }
        elseif($tree === 'form') {
            for($i = 0; $i < sizeof($table_info['ids']); $i++){
                $table_info['ids'][$i] .= "-$tree";
            }
        }
        return $table_info;
    }

    private function createTreeJSON($roots){
        $tmp_result = array();

        foreach($roots as $root){
            $tmp_result['id'] = $root['id'];
            $tmp_result['title'] = $root['name'];
            $children = $this->organization_model->getChildern($root['child_trail'], 1);

            //print_r($tmp_result['root']);
            foreach($children as $root){
                $this->createChildrenJSON($root['child_trail']);
            }
        }

        return $tmp_result;
    }

    private function createChildrenJSON($trail){
        $children = $this->organization_model->getChildern($trail);
        $parent_depth = (round((strlen($trail) - strlen(str_replace(',', '', $trail)))/strlen(',')));

        $sub_tree = array();
        $max_child_depth = 1;

        if (sizeof($children) > 0){
            foreach ($children as $child){
                $child_depth = (round((strlen($child['child_trail']) - strlen(str_replace(',', '', $child['child_trail'])))/strlen(',')));
                if(($child_depth - $parent_depth) == 1){
                    //echo('hi');
                    array_push($sub_tree, $child);
                }
                else{
                    $max_child_depth = ($child_depth > $max_child_depth) ? $child_depth : $max_child_depth;
                }
            }
            for($i = $max_child_depth; $i > 1; $i--){
                $tmp_tree = array();
                foreach($children as $child){
                    $child_depth = (round((strlen($child['child_trail']) - strlen(str_replace(',', '', $child['child_trail'])))/strlen(',')));

                    if(($child_depth - $parent_depth) == $i){
                        array_push($tmp_tree, $child);
                    }
                    echo "tmp_tree";
                    print_r($tmp_tree);
                    echo "<br>";
                }
            }
        }

        echo("max depth: " . $max_child_depth . "<br>");
        print_r($sub_tree);
        echo "<br>";
    }
}