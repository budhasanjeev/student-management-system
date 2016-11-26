<?php

/**
 * Created by PhpStorm.
 * User: Sanjeev
 * Date: 8/31/2016
 * Time: 7:08 PM
 */
include '../config/databaseConnection.php';

class Common{

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
            include '../Classes/PHPExcel/IOFactory.php';

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

    public function attendanceExcel($file_name,$file_temp){

        global $connection;

        $data = array();
        print("test");

        try{
            include '../Classes/PHPExcel/IOFactory.php';

            $objPHPExcel = PHPExcel_IOFactory::load("../excelFiles/attendance/$file_name");
        }catch (Exception $e) {
            die('Error loading file "' . pathinfo($file_temp, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

        $arrayCount = count($allDataInSheet);

        for($i = 2; $i <= $arrayCount; $i++){
            print("loop");

            $subject = trim($allDataInSheet[$i]['A']);

            $present_days= trim($allDataInSheet[$i]['B']);
            $student_id= trim($allDataInSheet[$i]['C']);
            $absent_days= trim($allDataInSheet[$i]['D']);


            $created_date = date("Y-m-d");

            $insert_query = "insert into attendance(subject,present_days,absent_days,student_id,created_date) values('$subject','$present_days','$absent_days','$student_id','$created_date')";
            print("sql");
            if(mysqli_query($connection,$insert_query)){
                $data['message'] = 'success';
            }
            else{
                $data['message'] = 'fail';
            }
        }

        return $data;
    }

    public function getStudent(){
        global $connection;

        $select_student = "select *from student";

        $result = mysqli_query($connection,$select_student);

        $data = array();

        $i = 0;

        while ($row = mysqli_fetch_assoc($result)){
            $data[$i]['id'] = $row['id'];
            $data[$i]['student_id'] = $row['student_id'];
            $data[$i]['first_name'] = $row['first_name'];
            $data[$i]['last_name'] = $row['last_name'];
            $data[$i]['dob'] = $row['dob'];
            $data[$i]['address'] = $row['address'];
            $data[$i]['contact_number'] = $row['contact_number'];
            $data[$i]['father_name'] = $row['father_name'];
            $data[$i]['mother_name'] = $row['mother_name'];
            $data[$i]['roll_number'] = $row['roll_number'];
            $data[$i]['grade'] = $row['grade'];
            $data[$i]['section'] = $row['section'];
            $data[$i]['photo'] = $row['photo'];
            $i++;
        }

        return $data;
    }

    public function createStudent($std_id,$fname,$lname,$dob,$address,$contact,$rollNumber,$grade,$section,$fatherName,$motherName,$photo){

        global $connection;

        $created_date = date('Y-m-d');

        $insert_student = "insert into student(student_id,first_name,last_name,dob,address,contact_number,father_name,mother_name,roll_number,grade,section,photo,created_date)
                            values('$std_id','$fname','$lname','$dob','$address','$contact','$fatherName','$motherName','$rollNumber','$grade','$section','$photo','$created_date')";

        $result = mysqli_query($connection,$insert_student);

        $classID = getClassID($grade, $connection);

        $select = "SELECT * FROM `student` WHERE `student_id` = '$std_id' && `first_name` = '$fname' && `last_name` = '$lname'";
        $forID = $connection->query($select);
        while($row = $forID->fetch_assoc()){
            $student_id = $row['id'];
            $insert = "INSERT INTO `attendance`(`class_id`, `student_id`) VALUES ($classID, $student_id)";
            $connection->query($insert);
        }

        return $result;

    }

    public function editStudent($id){

        global $connection;

        $select_student = "select *from student where id = '$id' ";

        $data = array();

        $result = mysqli_query($connection,$select_student);

        while ($row = mysqli_fetch_assoc($result)){

            $data['id'] = $row['id'];
            $data['student_id'] = $row['student_id'];
            $data['first_name'] = $row['first_name'];
            $data['last_name'] = $row['last_name'];
            $data['dob'] = $row['dob'];
            $data['address'] = $row['address'];
            $data['contact_number'] = $row['contact_number'];
            $data['father_name'] = $row['father_name'];
            $data['mother_name'] = $row['mother_name'];
            $data['roll_number'] = $row['roll_number'];
            $data['grade'] = $row['grade'];
            $data['section'] = $row['section'];
            $data['photo'] = $row['photo'];
        }

        return $data;
    }

    public function updateStudent($std_id,$fname,$lname,$dob,$address,$contact,$rollNumber,$grade,$section,$fatherName,$motherName,$photo,$id){

        global $connection;

        $updated_date = date('Y-m-d');

        $update_student = "update student set student_id = '$std_id',first_name = '$fname',last_name='$lname',dob = '$dob',address='$address',contact_number='$contact',father_name='$fatherName',mother_name='$motherName',roll_number='$rollNumber',grade='$grade',section='$section',photo='$photo',updated_date='$updated_date' where id = '$id' ";

        $result = mysqli_query($connection,$update_student);

        return $result;
    }

    public function deleteStudent($id){

        global $connection;

        $delete_student = "delete from student where id = '$id'";

        $result = mysqli_query($connection,$delete_student);

        $data = array();

        if($result){
            $data['message'] = 'success';
        }
        else{
            $data['message'] = 'fail';
        }

        return $data;
    }

    public function addRoutine($class,$file,$class_id)
    {


        global $connection;
        $created_date = date("Y-m-d");
        $password = md5('123');
        $sql = "SELECT class_id FROM routine WHERE class_id='$class_id'";
        $result1 = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result1) >0)
        {
            echo "<script>
        alert('routine already exist!');
    </script>";

        }else{
         //   not found
        $add_routine = "INSERT INTO routine(class_id,class, file) VALUES('$class_id','$class','$file')";

        $result = mysqli_query($connection,$add_routine);

        return $result;
        }



    }

    public function updateRoutine($file,$class_id){

        global $connection;

        $update_fee = "update routine set file = '$file' where class_id = '$class_id' ";

        $result = mysqli_query($connection,$update_fee);

        return $result;

    }

    public function addFee($file,$class_id)
    {


        global $connection;
        $created_date = date("Y-m-d");
        $password = md5('123');
        $sql = "SELECT class_id FROM routine WHERE class_id='$class_id'";
        $result1 = mysqli_query($connection,$sql);

        if(mysqli_num_rows($result1) >0)
        {
            echo "<script>
        alert('Fee already exist!');
    </script>";

        }else {

            $add_fee = "INSERT INTO fee (class_id, file) VALUES('$class_id','$file')";

            $result = mysqli_query($connection, $add_fee);

            return $result;
        }

    }

    public function updateFee($file,$class_id){

        global $connection;

        $update_fee = "update fee set file = '$file' where class_id = '$class_id' ";

        $result = mysqli_query($connection,$update_fee);

        return $result;
    }

    public function createUser($firstName,$lastName,$username,$role,$emailAddress,$student_id,$image){

        global $connection;

        $created_date = date("Y-m-d");
        $password = md5('123');

        $create_user = "INSERT INTO user(first_name, last_name, username, password, role, email, student_id, photo, created_date) VALUES('$firstName','$lastName','$username','$password','$role','$emailAddress','$student_id','$image','$created_date')";

        $result = mysqli_query($connection,$create_user);

        return $result;
    }

    public function editUser($id){

        global $connection;

        $select_query = "SELECT *FROM user WHERE id ='$id'; ";

        $result = mysqli_query($connection,$select_query);

        $data = array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['first_name'] = $row["first_name"];
            $data['last_name'] = $row["last_name"];
            $data['username'] = $row["username"];
            $data['role'] = $row["role"];
            $data['email'] = $row["email"];
            $data['photo'] = $row["photo"];
            $data['student_id'] = $row["student_id"];
        }

        return $data;
    }

    public function updateUser($firstName,$lastName,$username,$role,$emailAddress,$student_id,$image,$user_id){

        global $connection;

        $updated_date = date("Y-m-d");

        $create_user = "update user set first_name = '$firstName',last_name='$lastName',username='$username', role ='$role',email='$emailAddress',student_id='$student_id',photo='$image',updated_date='$updated_date' WHERE id = '$user_id'";

        $result = mysqli_query($connection,$create_user);

        return $result;
    }

    public function deleteUser($id){

        global $connection;

        $delete_user = "DELETE FROM user WHERE id='$id' ";

        $result = mysqli_query($connection,$delete_user);

        $data = array();

        if($result){
            $data['message']='success';
        }else{
            $data['message']='error';
        }

        return $data;
    }

    public function getFee($id){
        global $connection;
        $res="SELECT *FROM fee WHERE class_id='$id'";

        $result= mysqli_query($connection,$res);
        // $data= array();

        while($row = mysqli_fetch_assoc($result))
        {
//        $data['id'] = $row["id"];
//        $data['class'] = $row["class"];
            $data = $row["file"];

        }

        return $data;


    }

    public function getRoutine($id){

        global $connection;

        $res="SELECT *FROM routine WHERE class_id='$id'";

        $result= mysqli_query($connection,$res);

        $data= array();

        while($row = mysqli_fetch_assoc($result))
        {
            $data['id'] = $row["id"];
            $data['class_id'] = $row["class_id"];
            $data['file'] = $row["file"];

        }

        return $data;


    }

    public function getUser(){

        global $connection;

        $select_user = "SELECT *FROM user";

        $result = mysqli_query($connection,$select_user);

        $data = array();

        $i = 0;

        while($row = mysqli_fetch_assoc($result))
        {
            $data[$i]['id'] = $row["id"];
            $data[$i]['first_name'] = $row["first_name"];
            $data[$i]['last_name'] = $row["last_name"];
            $data[$i]['username'] = $row["username"];
            $data[$i]['role'] = $row["role"];
            $data[$i]['email'] = $row["email"];
            $data[$i]['photo'] = $row["photo"];
            $i++;
        }

        return $data;

    }

    public function FeeExcel($file_name,$file_temp){

        global $connection;

        $data = array();

        try{
            $objPHPExcel = PHPExcel_IOFactory::load("../excelFiles/Fee/$file_name");
        }catch (Exception $e) {
            die('Error loading file "' . pathinfo($file_temp, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);

        $arrayCount = count($allDataInSheet);

        for($i = 2; $i <= $arrayCount; $i++){

            $id = trim($allDataInSheet[$i]['A']);

            $tution= trim($allDataInSheet[$i]['B']);
            $lab= trim($allDataInSheet[$i]['C']);
            $hostel= trim($allDataInSheet[$i]['D']);
            $sports= trim($allDataInSheet[$i]['E']);
            $outing= trim($allDataInSheet[$i]['F']);
            $fooding= trim($allDataInSheet[$i]['G']);
            $miscellaneous= trim($allDataInSheet[$i]['H']);

            $created_date = date("Y-m-d");
            $updated_date= date("Y-m-d");

            $insert_query = "insert into fee(id,tution,lab,hostel,sports,outing,fooding,miscellaneous) values('$id','$tution','$lab','$hostel','$sports','$outing','$fooding','$miscellaneous')";

            if(mysqli_query($connection,$insert_query)>0){
                $data['message'] = 'success';
            }
            else{
                $data['message'] = 'fail';
            }
        }

        return $data;
    }

    function createTeacher($name,$contact,$addres,$experience,$username,$address,$degree,$join_on,$photo,$email){

        global $connection;

        $created_date = date('Y-m-d');

        $password = md5("@".$username."123#");

        $insert_teacher = "insert into teacher(name,address,contact,email,username,password,degree,experience,start_date,photo,created_date) values('$name','$addres','$contact','$email','$username','$password','$degree','$experience','$join_on','$photo','$created_date')";

        $result = mysqli_query($connection,$insert_teacher);

        return $insert_teacher;

    }

    public function getAllTeacher(){
        global $connection;

        $select_teacher = "select *from teacher";

        $result = mysqli_query($connection,$select_teacher);

        $data = array();

        $i = 0;

        while ($row = mysqli_fetch_assoc($result)){
            $data[$i]['id'] = $row['id'];
            $data[$i]['name'] = $row['name'];
            $data[$i]['address'] = $row['address'];
            $data[$i]['contact'] = $row['contact'];
            $data[$i]['email'] = $row['email'];
            $data[$i]['username'] = $row['username'];
            $data[$i]['degree'] = $row['degree'];
            $data[$i]['experience'] = $row['experience'];
            $data[$i]['start_date'] = $row['start_date'];
            $data[$i]['photo'] = $row['photo'];
            $i++;
        }

        return $data;
    }

    function getImageName($id){

        global $connection;

        $select_fee = "select file from fee where class_id = $id";

        $result = mysqli_query($connection,$select_fee);

        $data = array();

        $row = mysqli_fetch_assoc($result);

        $data['file'] = $row['file'];

        return $data;
    }

    public function getRoutinePhoto($id){

        global $connection;

        $select_routine = "select file from routine where class_id = $id";

        $result = mysqli_query($connection,$select_routine);

        $data = array();

        $row = mysqli_fetch_assoc($result);

        $data['file'] = $row['file'];

        return $data;
    }

    function deletePhoto($fileName){

        $data = array();

        if(unlink("../img/".$fileName)){
            $data['message'] = 'success';
        }
        else{
            $data['message'] = 'fail';
        }

        return $data;
    }

}