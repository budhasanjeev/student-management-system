<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 12/16/2016
 * Time: 1:55 PM
 */

session_start();

if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
$student_id = $_GET['id'];

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

</div>
</body>
</html>

<?php
}else{
    header('Location: logout.php');
}
?>
