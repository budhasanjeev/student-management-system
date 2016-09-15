<?php
/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:17 PM
 */

include '../common/Common.php';

$objCommon = new Common();

if(isset($_POST['submit'])){

    if($_POST['mode']=='excel'){

        $student_record = $_FILES['student_excel']['name'];
        $student_record_temp = $_FILES['student_excel']['tmp_name'];

        $ext = pathinfo($student_record, PATHINFO_EXTENSION);

        $file_name = rand(0,9).'.'.$ext;
        move_uploaded_file($student_record_temp, "../excel_files/$file_name");

        $result = $objCommon->createStudentList($file_name,$student_record_temp);

        if($result['message']=='success'){

            echo '<script>
                    alert("successfully added");
                  </script>';
        }
        else{
            echo '<script>
                    alert("already inserted");
                </script>';
        }
    } else if($_POST['mode']=='add'){

        $std_id = $_POST['student_id'];
        $fname  = $_POST['firstName'];
        $lname  = $_POST['lastName'];
        $dob    = $_POST['dob'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $rollNumber = $_POST['rollNumber'];
        $grade   = $_POST['grade'];
        $section = $_POST['section'];
        $fatherName = $_POST['fatherName'];
        $motherName = $_POST['motherName'];

        $photo = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        
        move_uploaded_file($photo_tmp,"../images/$photo");

        $result = array();

        $result = $objCommon->createStudent($std_id,$fname,$lname,$dob,$address,$contact,$rollNumber,$grade,$section,$fatherName,$motherName,$photo);
        
        if($result['message']=='success'){
            echo '<script>
                    alert("Successfully created");
                  </script>';

        }else{
            echo '<script>
                    alert("Unsuccessful");
                  </script>';
        }

    } else if(isset($_POST['mode'])=='edit'){

        $std_id = $_POST['id'];
        
        $result = array();
        
        $result = $objCommon->editStudent($std_id);
        
    } else if(isset($_POST['mode'])=='edit'){

    }

}