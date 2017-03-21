<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/18/2016
 * Time: 11:50 AM
 */

session_start();

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Student Management</title>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<?php include 'layout/header.php'; ?>

<div class="container">
    <h4>Upgrading class will clear all the attendance and results and change all the students current class to next upper class. This is to be done in the beginning of new academic session.
        <br/><br/>Are you sure you want to upgrade ?</h4>

    <button class="btn btn-block btn-primary" onclick="upgrade_class();">Yes, Upgrade Class</button>
    </div>

    <div style="text-align: center" id="updating" hidden>
        <img src="../img/updating.gif" >
    </div>

<script>

   function upgrade_class() {

       $('#updating').show();

       $.ajax({
           type:"POST",
           cache:false,
           url:"../controller/updateClass.php",
           success:function(data){
               var data = JSON.parse(data);
           },
           complete: function(){
               setTimeout(function () {
                   $('#updating').hide();
               },1000)

           }


       })
   }

</script>
</body>
</html>
<?php
}else{
    header('Location: logout.php');
}
?>
