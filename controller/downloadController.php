<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 12/26/2016
 * Time: 9:15 PM
 */

if(isset($_GET['link'])){

    $file_name = $_GET['link'];
    $dir = "../sample/";
    $file = $dir . $file_name;

    echo $file;

    if (file_exists($file))
    {
        echo "sanjeev";

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
    }
}