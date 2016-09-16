<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 9/15/2016
 * Time: 7:42 PM
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
    <div class="col-md-1">
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 1</a>
        <a class="btn btn-block btn-block" href="">Class 10</a>
    </div>
    <div class="col-md-11">
        <legend>Attendance</legend>

        <form action="">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Ram</th>
                <th>Hari</th>
                <th>Ram</th>
                <th>Ram</th>
                <th>Ram</th>
                <th>Ram</th>
                <th>Ram</th>
                <th>Hari</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
            </tr>
            <tr>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
                <td>p</td>
            </tr>
            <tr>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
                <td><select name="attendance">
                        <option value="volvo">Absent</option>
                        <option value="saab">Present</option>
                        <option value="saab">Leave</option>
                    </select>
                </td>
            </tr>
            </tbody>
        </table>
            <input class="btn btn-primary pull-right" value="Done" type="submit"/>
        </form>
    </div>
</div>
</body>
</html>