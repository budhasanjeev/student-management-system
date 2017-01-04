<?php
/**
 * Created by PhpStorm.
 * User: sanjeevbudha
 * Date: 6/25/16
 * Time: 1:08 PM
 */


include('../config/DatabaseConnection.php');
include('../common/service.php');

if(isset($_POST['formType'])=='change'){

    $user_email = $_POST['user-email'];

    $userCheck = validateEmailR($user_email,$connection);
    $teacherCheck = validateTeacherEmailR($user_email,$connection);

   if($userCheck || $teacherCheck){

       $admin_email = getAdminEmail($connection);

       $row = mysqli_fetch_assoc($admin_email);

       if($userCheck){
           $flag = "u";
       }
       else if($teacherCheck){
           $flag = 't';
       }

       $password = random_password($connection,$user_email, $flag);

       require_once('../PHPMailer-master/PHPMailerAutoload.php');
       $mail = new PHPMailer();
       $mail->CharSet =  "utf-8";
       $mail->IsSMTP();
// enable SMTP authentication
       $mail->SMTPAuth = true;
//$mail->SMTPDebug = 1;
// GMAIL username
       $mail->Username = $row['email'];
// GMAIL password
       $mail->Password = $row['password'];
       $mail->SMTPSecure = "ssl";
// sets GMAIL as the SMTP server
       $mail->Host = "smtp.gmail.com";
// set the SMTP port for the GMAIL server
       $mail->Port = "465";
       $mail->From=$row['email'];
       $mail->FromName='Student Management System';
       $mail->AddAddress($user_email);
       $mail->Subject  =  'Password Has Been Changed';
       $mail->IsHTML(true);
       $mail->Body    = 'Hello! Don\'t worry about forgetting your password, following is your <br><br>Email:'.$user_email.'<br>Password: '.$password.' <br><br>Best Wishes,<br>Student Management System.';

       if($mail->Send())
       {
           $_SESSION['message']='Admin credentials have been sent to admin email address';

           header("Location:../views/login.php");
       }
       else
       {
           $_SESSION['message']=$mail->ErrorInfo;
       }

   }

   else{
       echo "Email does not exist";
   }

}