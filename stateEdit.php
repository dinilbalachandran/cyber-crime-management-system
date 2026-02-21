<?php
session_start();
if (isset($_SESSION['loginid'])) {
    include 'header.html';
    echo"'<h1>'HELLO'</h1>'";
}
?>