<?php
/**
 * Created by PhpStorm.
 * User: shervin.hassanzadeh
 * Date: 3/4/15
 * Time: 9:43 AM
 */
include_once 'common/header.tmpl.php';

if (!$_SESSION['member']->CheckLogin())
{
    header('Location: ../index.php?control=main&action=enter');
}