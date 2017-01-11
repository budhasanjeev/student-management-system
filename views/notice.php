<?php
/**
 * Created by PhpStorm.
 * User: Pratik
 * Date: 1/11/2017
 * Time: 8:23 PM
 */

session_start();

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

        <!--makeNotice Modal -->
        <div id="noticeModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Make notice</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="../controller/c_notice.php" method="post">
                            <div class="form-group">
                                <label for="sel1">Visible to:</label>
                                <select class="form-control" id="sel1" name="visible" required="">
                                    <option value="all">All</option>
                                    <option value="parents">Parents Only</option>
                                    <option value="teachers">Teachers Only</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="class">Title: </label>
                                <input class="form-control" type="text" name="title" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="class">Date: </label>
                                <input class="form-control" type="date" name="date" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="class">Notice: </label><br/>
                                <textarea name="notice" id="" cols="30" rows="10" style="width: 100%; max-width: 100%;"></textarea>
                            </div>
                            <div style="text-align: right">
                                <button type="submit" class="btn btn-success">Publish</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <?php
        if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
            ?>
            <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#noticeModal">Make Notice</button>
        <?php
        }

        $notice = getNotice($_SESSION['role'], $connection);

        while($row = $notice->fetch_assoc()){
            ?>
            <div class="row">
                <div class="notice">
                    <?php
                    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'sAdmin'){
                    ?>
                    <a href="../controller/deleteNotice.php?id=<?php echo $row['id']; ?>" class="btn btn-default pull-right"><span class="glyphicon glyphicon-trash"></span></a>
                    <?php
                    }
                    ?>
                    <h2><?php echo $row['title']; ?></h2>
                    <h5><?php echo $row['date']; ?></h5>
                    <p><?php echo $row['notice']; ?></p>
                    <h5 style="text-align: right;">-The School Admin Department</h5>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
    </body>
    </html>

