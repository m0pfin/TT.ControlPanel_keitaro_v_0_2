<?php
/**
 * Created by PhpStorm.
 * User: m0pfin
 * Date: 11.07.2020
 * Time: 19:22
 */

include 'include/db.php';

if(isset($_POST['name'])){

    //принимаем данные из POST
    $name = $_POST['name'];
    $token = $_POST['token'];

    // записываем в БД
    $db->execute("INSERT INTO `tokens`(`name`, `token`) VALUES ('$name', '$token')");
    header("Location: index.php?add=success");
}
