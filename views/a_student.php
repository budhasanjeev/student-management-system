<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/18/2016
 * Time: 1:37 PM
 */

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
    <div class="row">
        <legend><a href="a_class.php">Class</a>/students</legend>
    </div>

    <?php
    $id = $_GET['id'];
    $class = getClassName($id, $connection);
    $student = getClassStudents($class, $connection);
    ?>

    <table class="table">
        <thead>
        <tr>
            <th>Photo</th>
            <th>name</th>
            <th>roll.no</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row = $student->fetch_assoc()){
            ?>

            <tr>
                <a href="a_profile.php?id=<?php echo $row["id"]; ?>">
                    <td><a href="a_profile.php">photo</a></td>
                    <td><?php echo $row["first_name"]." ". $row["last_name"]; ?></td>
                    <td><?php echo $row["roll_number"]; ?></td>
                </a>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>