<?php 
include_once "config.php";

function genereateID() {

    $currentDate = date('dmyHis');

    $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

    $id = rand($currentDate,$randomNumber);
    $currentDate = date('dmyHis');
    $userID = substr($id, 0, 10);
    return $userID;
}
