<?php
date_default_timezone_set('Asia/Kolkata');
function getconnection(){
    $con=mysqli_connect("localhost","root","") or die("Could not connect to database!");
    return $con;
}
function encrypt($data,$key = "*&^!@#%$"){
    $iv = "(qiehd^&#JMhU)))";
    return $encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);
}

function decrypt($data,$key = "*&^!@#%$"){
    $iv = "(qiehd^&#JMhU)))";
    return openssl_decrypt($data, 'aes-256-cbc', $key, 0, $iv);
}

function e1($data,$key = 6){
    $e = "";
    for($i = 0;$i<strlen($data); $i++){
        $c = ord($data[$i]);
        $e.= chr($c+$key);
    }
    return $e;
}

function d1($data,$key = 6){
    $d = "";
    $ct = $data;
    for($i = 0;$i<strlen($ct); $i++){
        $c = ord($data[$i]);
        $d.= chr($c-$key);
    }
    return $d;
}
?>