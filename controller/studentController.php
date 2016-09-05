<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:17 PM
 */
include '../PHPExcel/Classes/PHPExcel/IOFactory.php';
include '../config/databaseConnection.php';

if(isset($_POST['submit'])){

        $student_record = $_FILES['student_excel']['name'];
        $student_record_temp = $_FILES['student_excel']['tmp_name'];

        move_uploaded_file($student_record_temp, "../excel_files/$student_record");

    echo $student_record;

        try{
            $objPHPExcel = PHPExcel_IOFactory::load($student_record);
        }catch (Exception $e) {
            die('Error loading file "' . pathinfo($student_record_temp, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

        $arrayCount = count($allDataInSheet);

        for($i = 2; $i <= $arrayCount; $i++){
            $student_id = trim($allDataInSheet[$i]['id']);
            $first_name = trim($allDataInSheet[$i]['first_name']);

            $duplicate_check_query = "select student_id from student where student_id = '$student_id'";

            $result = mysqli_query($connection,$duplicate_check_query);

            $row = mysqli_fetch_assoc($result);

            $std_id = $row['student_id'];

            if($std_id == ''){
                $insert_query = "insert into student(student_id,first_name) values('$student_id','$first_name')";

                $result1 = mysqli_query($connection,$insert_query);

                $msg = 'Record has been added';
            }
            else{
                $msg = 'Record already exist';
            }
        }
    echo $msg;
}