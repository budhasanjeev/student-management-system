<?php

/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:08 PM
 */

require('../config/databaseConnection.php');

include '../PHPExcel/Classes/PHPExcel/IOFactory.php';

class Common
{

    public function login($username,$pwd){

        global $connection;

        $pwd = md5($pwd);

        $login_query = "SELECT *FROM user WHERE email_address = '$username' and password='$pwd' ";

        $result = mysqli_query($connection,$login_query);

        $data = array();

        if(mysqli_num_rows($result)>0){

            $data['message']='success';

            while($row = mysqli_fetch_assoc($result)){
                $data['first_name'] = $row['first_name'];
                $data['last_name'] = $row['last_name'];
                $data['role'] = $row['role'];
            }

        }
        else{
            $data['message']='fail';
        }

        return $data;

    }

    public function createStudentList($file_name,$student_record_temp){

        global $connection;

        $data = array();

        try{
            $objPHPExcel = PHPExcel_IOFactory::load("../excel_files/$file_name");
        }catch (Exception $e) {
            die('Error loading file "' . pathinfo($student_record_temp, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

        $arrayCount = count($allDataInSheet);

        for($i = 2; $i <= $arrayCount; $i++){
            $student_id = trim($allDataInSheet[$i]['A']);
            $first_name = trim($allDataInSheet[$i]['B']);
            $last_name = trim($allDataInSheet[$i]['C']);
            $dob = trim($allDataInSheet[$i]['D']);
            $address = trim($allDataInSheet[$i]['E']);
            $contact_number = trim($allDataInSheet[$i]['F']);
            $father_name = trim($allDataInSheet[$i]['G']);
            $mother_name = trim($allDataInSheet[$i]['H']);
            $roll_number = trim($allDataInSheet[$i]['I']);
            $grade = trim($allDataInSheet[$i]['J']);
            $section = trim($allDataInSheet[$i]['K']);

            $duplicate_check_query = "select student_id from student where student_id = '$student_id'";

            $result = mysqli_query($connection,$duplicate_check_query);

            $row = mysqli_fetch_assoc($result);

            $std_id = $row['student_id'];

            if($std_id == ''){
                $created_date = date("Y-m-d");

                $insert_query = "insert into student(student_id,first_name,last_name,dob,address,contact_number,father_name,mother_name,roll_number,grade,section,created_date) values('$student_id','$first_name','$last_name','$dob','$address','$contact_number','$father_name','$mother_name','$roll_number','$grade','$section','$created_date')";

                if(mysqli_query($connection,$insert_query)>0){
                    $data['message'] = 'success';
                }
            }
            else{
                $data['message'] = 'fail';
            }
        }

        return $data;
    }

    public function createStudent($std_id,$fname,$lname,$dob,$address,$contact,$rollNumber,$grade,$section,$fatherName,$motherName,$photo){

        global $connection;

        $created_date = date('Y-m-d');

        $insert_student = "insert into student(student_id,first_name,last_name,dob,address,contact_number,father_name,mother_name,roll_number,grade,section,photo,created_date)
                            values('$std_id','$fname','$lname','$dob','$address','$contact','$fatherName','$motherName','$rollNumber','$grade','$section','$photo','$created_date')";

        $result = mysqli_query($connection,$insert_student);

        $data = array();

        if($result){
            $data['message'] = 'success';
        }else{
            $data['message'] = 'fail';
        }

        return $data;
    }
    
}