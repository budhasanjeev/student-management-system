<?php
/**
 * Created by PhpStorm.
 * User: anijor
 * Date: 12/16/2016
 * Time: 12:46 PM
 */


include "../config/databaseConnection.php";
session_start();
echo "Here";
echo $_SESSION['role'];
if(isset($_POST['submit'])) {
    if ($_SESSION['role'] == "Admin" || "Parents") {
        echo $_SESSION['role'];
        $result = mysqli_query($connection, "SELECT *from user WHERE id='" . $_SESSION["user_id"] . "'");
        $row = mysqli_fetch_array($result);
        $currentPassword = $_POST["currentPassword"];
        if (md5($currentPassword) == $row["password"]) {
            $newPw = $_POST["newPassword"];
            mysqli_query($connection, "UPDATE user set password='" . md5($newPw) . "' WHERE id='" . $_SESSION["user_id"] . "'");
            $message = "Password Changed";
        } else $message = "Current Password is not correct";
    } elseif ($_SESSION['role'] == "teacher") {
        echo $_SESSION['role'];
        $result = mysqli_query($connection, "SELECT *from teacher WHERE id='" . $_SESSION["user_id"] . "'");
        $row = mysqli_fetch_array($result);
        $currentPassword = $_POST["currentPassword"];
        if (md5($currentPassword) == $row["password"]) {
            $newPw = $_POST["newPassword"];
            mysqli_query($connection, "UPDATE teacher set password='" . md5($newPw) . "' WHERE id='" . $_SESSION["user_id"] . "'");
            $message = "Password Changed";
        } else $message = "Current Password is not correct";
    }

    header("Location: admin.php");
}
