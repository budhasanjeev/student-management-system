<?php
    include("../common/Common.php");
    include("../config/DatabaseConnection.php");

?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

</head>

<body>



<div class="container" style="display: flex; height: 80%; justify-content: center; align-items: center;">


    <form class="form-signin loginForm" method="post" action="../controller/auth.php" enctype="multipart/form-data">
        <input type="hidden" value="change" name="formType">
        <h3 style="font-family: 'Ultra', serif; text-align: center;">Student Management Portal</h3>
        <div class="form-group">
        <label class="control-label" >Username and Password will be sent to  your email address</label><br>

        <input type="email" class="form-control" placeholder="enter your email" name="user-email">
        </div>
        <input type="submit" class="btn btn-primary" name="change" id="change" value="Change"/>
        <br/>
    </form>

    <div class="row">

    </div>

    <?php $_SESSION['message']=''?>

</div>

</body>
</html>