<?php
session_start();

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}
?>
<table width="80%" border="1">
    <tr>
    <td>File id</td>
    <td>grade</td>
    <td>routine</td>
    <td>View</td>
    </tr>
<?php


include '../config/databaseConnection.php';
$sql="SELECT * from class_routine";
$resultset= $connection->query($sql);
 while($row=mysqli_fetch_array($resultset))
{
?>
    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['grade'] ?></td>
        <td><?php echo $row['pdf_name'] ?></td>
        <td><a href="../uploads/<?php echo $row['pdf_name'] ?>" target="_blank">view file</a></td>

    </tr>

<?php
}
?>
</table>
