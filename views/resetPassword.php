<?php
include('../common/Common.php');
include('../config/DatabaseConnection.php');

if(isset($_POST['change'])) {

    echo "hello";

    $old_password = $_POST['oldPassword'];
    $new_password = $_POST['newPassword'];
    $reenter_new_password = $_POST['renewPassword'];

    if ($new_password == $reenter_new_password) {
        $session_username = $_SESSION['username'];
        $selectPassword = "SELECT password FROM user WHERE username = '$session_username'";
        $result = mysqli_query($connection, $selectPassword);

        if (mysqli_num_rows($result) > 0) {
            while ($row_query = mysqli_fetch_array($result)) {
                $db_password = $row_query['password'];
            }

            if (md5($old_password) == $db_password) {
                $new_db_password = md5($new_password);
                $db_new_password = "UPDATE user SET password='$new_db_password' WHERE username = '$session_username'";
                mysqli_query($connection,$db_new_password);
                header("Location: deliveryStatus.php");
            }

            else{
                echo "Your old password and new password doesn't match."."<br>";
                echo "<a style = 'font-size: 22px' href = 'deliveryStatus.php'>Home</a>";

            }

        } else {
            echo "Please log in."."<br>";
            echo "<a style = 'font-size: 22px' href = 'deliveryStatus.php'>Home</a>";

        }
    }else{
        echo "New Passwords don't match."."<br>";
        echo "<a style = 'font-size: 22px' href = 'deliveryStatus.php'>Home</a>";

    }


}

