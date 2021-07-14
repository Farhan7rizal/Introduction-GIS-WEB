<?php
if (isset($_POST['username'])) {
    $username = $_POST['username'];
}
if (isset($_POST['password'])) {
    $password = $_POST['password'];
}
echo "SELECT username, password FROM users WHERE username='{$username}' AND password='{$password}'";
