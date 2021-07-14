<?php include "includes/init.php" ?>
<?php
if (isset($_GET['user'])) {
    $user = $_GET['user'];
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $db_code = get_validationcode($user, $pdo);
        if ($code == $db_code) {
            try {
                $stmnt = $pdo->prepare("UPDATE users SET active=1 WHERE username=:username");
                $stmnt->execute([':username' => $user]);
                // $_SESSION['message'] = "User Activated, Please login to access your content";
                set_msg("User Activated, Please login to access your content", "success");
                redirect('index.php');
            } catch (PDOException $e) {
                echo "Error: {$e}";
            }
        } else {
            $_SESSION['message'] = "Validation code does not match the database - '{$db_code}'='{$code}'";
            redirect('index.php');
        }
    } else {
        $_SESSION['message'] = "No validation code included with activate request";
        redirect('index.php');
    }
} else {
    // $_SESSION['message'] = "No user included with activate request";
    set_msg("No user included with activate request");
    redirect('index.php');
}
?>