<?php
session_start();
    function getLast()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $name = ucwords(ucfirst(strtoupper($row['LAST_M'])));
            echo $name;
        }
    }
    function getFirst()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $name = ucwords(ucfirst(strtoupper($row['FIRST_M'])));
            echo $name;
        }
    }
    function getMiddle()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo where tblemployeeinfo.UNAME  = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $name = ucwords(ucfirst(strtoupper($row['MIDDLE_M'])));
            echo $name;
        }
    }
    function getContact()
    {
        include 'connection.php';
        $query = "SELECT MOBILEPHONE FROM tblemployeeinfo where tblemployeeinfo.UNAME  =  '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $no = $row['MOBILEPHONE'];
            echo $no;
        }
    }
    function getEmail()
    {
        include 'connection.php';
        $query = "SELECT EMAIL FROM tblemployeeinfo where tblemployeeinfo.UNAME  =  '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $email = $row['EMAIL'];
            echo $email;
        }
    }
    function getAddress()
    {
        include 'connection.php';
        $query = "SELECT c.province_id,m.city_title, c.province_title FROM tblemployeeinfo  a 
        LEFT JOIN tblprovinse c on c.province_id = a.PROVINCE_C 
        LEFT JOIN tblmunicipality m on a.CITYMUN_C = m.city_id AND m.province = c.province_id
        
        WHERE a.UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $address = $row['city_title'].','.$row['province_title'];
            echo $address;
        }
    }
    function calculateAge(){
        include 'connection.php';
        $query = "SELECT BIRTH_D FROM tblemployeeinfo WHERE UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $birthDate = date('m/d/Y',strtotime($row['BIRTH_D']));


            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
              ? ((date("Y") - $birthDate[2]) - 1)
              : (date("Y") - $birthDate[2]));
            echo $age;
        }
    }
    function getGender(){
        include 'connection.php';
        $query = "SELECT SEX_C FROM tblemployeeinfo WHERE UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            echo $row['SEX_C'];
        }
    }
    function getOffice()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblemployeeinfo a 
                  LEFT JOIN tblpersonneldivision b on b.DIVISION_N = a.DIVISION_C 
                  LEFT JOIN tbldesignation c on c.DESIGNATION_ID = a.DESIGNATION 
                  LEFT JOIN tbldilgposition d on d.POSITION_ID = a.POSITION_C WHERE UNAME = '".$_SESSION['username']."' ";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            echo $row['DIVISION_M'];
        }
    }
    function getOfficeExport()
    {
        include 'connection.php';
        $query = "SELECT * FROM tblpersonneldivision  ";
        $result = mysqli_query($conn, $query);
        echo '<select class="form-control " id="selectYear" style="width: 100%;">';
        
        while($row = mysqli_fetch_array($result))
        {
            
            echo '<option value = "'.$row['DIVISION_M'].'">'.$row['DIVISION_M'].'</option>';
        }
        echo ' </select> ';

    }
    

    // ======================= inserting =====================
    function add()
    {
          include 'connection.php';


        $insert ="INSERT INTO `tblhealth_monitoring`(`ID`, `DATE`, `UNAME`,`BODY_TEMPERATURE`, `CURRENT_ADDRESS`, `WORK_ARRANGEMENT`, `QUESTION_1`, `QUESTION_2`, `QUESTION_3`, `QUESTION_4`, `QUESTION_5`, `DETAILS_1`, `DETAILS_2`, `DETAILS_3`, `DETAILS_4`,`DETAILS_5`,`IS_SUBMIT`) VALUES 
        (null,
        '".date('Y-m-d',strtotime($_POST['date_today']))."',
        '".$_SESSION['username']."',
        '".$_POST['body_temp']." &deg C',
        '".$_POST['curraddress']."',
        '".$_POST['work_arrangement']."',
        '".$_POST['ans1']."',
        '".$_POST['ans2']."',
        '".$_POST['ans3']."',
        '".$_POST['ans4']."',
        '".$_POST['ans5']."',
        '".$_POST['ans1_details']."',
        '".$_POST['ans2_details']."',
        '".$_POST['ans3_details']."',
        '".$_POST['ans4_details']."',
        '".$_POST['ans5_details']."',
        '1'
        )";

       
       if (mysqli_query($conn, $insert)) {
    } else {
    }
     
    }


if(isset($_GET['action'])){
    if($_GET['action'] == 'add')
    {
        add();
        header('Location:HealthMonitoring.php?username="'.$_SESSION['username'].'"&division="'.$_SESSION['division'].'"');
    }
    
}
    
    

?>