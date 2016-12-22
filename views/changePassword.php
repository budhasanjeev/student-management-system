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
    if($_SESSION['role']=="Admin"||"Parents")
    {
        echo $_SESSION['role'];
        $result = mysqli_query($connection,"SELECT *from user WHERE id='" . $_SESSION["user_id"] . "'");
        $row=mysqli_fetch_array($result);
        $currentPassword=$_POST["currentPassword"];
        if(md5($currentPassword) ==  $row["password"]) {
            $newPw= $_POST["newPassword"];
            mysqli_query($connection,"UPDATE user set password='" . md5($newPw) . "' WHERE id='" . $_SESSION["user_id"] . "'");
            $message = "Password Changed";
        } else $message = "Current Password is not correct";
    }elseif($_SESSION['role']=="teacher")
    {
        echo $_SESSION['role'];
        $result = mysqli_query($connection,"SELECT *from teacher WHERE id='" . $_SESSION["user_id"] . "'");
        $row=mysqli_fetch_array($result);
        $currentPassword=$_POST["currentPassword"];
        if(md5($currentPassword) ==  $row["password"]) {
            $newPw= $_POST["newPassword"];
            mysqli_query($connection,"UPDATE teacher set password='" . md5($newPw) . "' WHERE id='" . $_SESSION["user_id"] . "'");
            $message = "Password Changed";
        } else $message = "Current Password is not correct";
    }


}
header("Location: admin.php");
?>
<!--<html>-->
<!--<head>-->
<!--<title>Change Password</title>-->
<!--<link rel="stylesheet" type="text/css" href="styles.css"/>-->
<!--    <script>-->
<!--        function validatePassword() {-->
<!--            var currentPassword,newPassword,confirmPassword,output = true;-->
<!---->
<!--            currentPassword = document.frmChange.currentPassword;-->
<!--            newPassword = document.frmChange.newPassword;-->
<!--            confirmPassword = document.frmChange.confirmPassword;-->
<!---->
<!--            if(!currentPassword.value) {-->
<!--                currentPassword.focus();-->
<!--                document.getElementById("currentPassword").innerHTML = "required";-->
<!--                output = false;-->
<!--            }-->
<!--            else if(!newPassword.value) {-->
<!--                newPassword.focus();-->
<!--                document.getElementById("newPassword").innerHTML = "required";-->
<!--                output = false;-->
<!--            }-->
<!--            else if(!confirmPassword.value) {-->
<!--                confirmPassword.focus();-->
<!--                document.getElementById("confirmPassword").innerHTML = "required";-->
<!--                output = false;-->
<!--            }-->
<!--            if(newPassword.value != confirmPassword.value) {-->
<!--                newPassword.value="";-->
<!--                confirmPassword.value="";-->
<!--                newPassword.focus();-->
<!--                document.getElementById("confirmPassword").innerHTML = "not same";-->
<!--                output = false;-->
<!--            }-->
<!--            return output;-->
<!--        }-->
<!--    </script>-->
<!--</head>-->
<!--<body>-->

<?php //include 'layout/header.php'; ?>
<!--<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">-->
<!--<div style="width:500px;">-->
<!--<div class="message">--><?php //if(isset($message)) { echo $message; } ?><!--</div>-->
<!--<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">-->
<!--    <tr class="tableheader">-->
<!--        <td colspan="2">Change Password</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td width="40%"><label>Current Password</label></td>-->
<!--        <td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td><label>New Password</label></td>-->
<!--        <td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>-->
<!--    </tr>-->
<!--    <td><label>Confirm Password</label></td>-->
<!--    <td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>-->
<!--    </tr>-->
<!--</table>-->
<!--</div>-->
<!--</form>-->
<!--</body></html>-->