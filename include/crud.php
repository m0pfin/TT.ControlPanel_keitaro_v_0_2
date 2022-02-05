<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 11.07.2020
 * Time: 23:48
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_startup_errors', 1);
ini_set('display_errors', '1');

include 'db.php';

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $db->query('DELETE FROM `tokens` WHERE id='.$id.'');
    header("Location: ../index.php?delete=success");
}