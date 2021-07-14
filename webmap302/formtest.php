<!-- SINGLE PAGE FORM -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $username = "";
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $password = "";
    }
    echo "SELECT username, password FROM users WHERE username='{$username}' AND password='{$password}'";
}


// foreach ($_SERVER as $key => $val) {
//     echo "<br>{$key} = {$val}<br>";
// }
?>
<form action="" method="post">
    username: <br>
    <input type="text" name="username"><br>
    password:<br>
    <input type="password" name='password'><br>
    <input type="submit" name="submit" value="submit">
</form>