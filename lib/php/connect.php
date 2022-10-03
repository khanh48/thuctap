<?php
$host = "localhost";
$user = "root";
$pass = "abc12345";
$db = "forum";
$con = new mysqli($host, $user, $pass, $db);
if ($con->connect_error) {
    die("Lỗi kết nối với cơ sở dữ liệu.");
}
