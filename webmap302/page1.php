<?php include "includes/init.php" ?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>

<body>
    <?php include "includes/nav.php" ?>

    <div class="container">
        <?php
        show_msg();
        ?>
        <?php
        // echo generate_token() . "<br>";
        // echo count_field_val($pdo, "users", "username", "a") . "<br>";
        ?>
        <h1 class="text-center">Page 1</h1>
        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. "</p>
    </div>

    <?php
    try {
        $result = $pdo->query("SELECT * FROM users");
        if ($result->rowCount() > 0) {
            echo "<table class='table'>";
            echo "<tr><th>Firtname</th><th>Lastname</th><th>Username</th><th>Password</th></tr>";
            foreach ($result as $row) {
                echo "<tr><td>{$row["firstname"]}</td><td>{$row["lastname"]}</td><td>{$row["username"]}</td><td>{$row["password"]}</td>";
            }
            echo "</table>";
        } else {
            echo "No users in user table";
        }
    } catch (PDOException $e) {
        echo "Oops there was an error <br><br>" . $e->getMessage();
    }
    ?>
    <!--Container-->

    <?php include "includes/footer.php" ?>
</body>

</html>