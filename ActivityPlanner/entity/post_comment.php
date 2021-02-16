<?php
session_start();
date_default_timezone_set('Asia/Manila');

require_once "../../connection.php";

    $remarks = $_GET['remarks'];
    $posted_by = $_SESSION['currentuser'];
    $id = $_GET['id'];
    $today = new DateTime();

    if (!empty($remarks)) {
        $data = [
            'task_id' => $id,
            'remarks' => $remarks,
            'posted_date' => $today->format('Y-m-d H:i:s'),
            'posted_by' => $posted_by
        ]; 

        insertComment($conn, $data);

        $result = fetchComment($conn, $id);

        echo $result; 
    }

    function insertComment($conn, $data) {
        $sql = "INSERT INTO event_subtasks_comment (task_id, remarks, posted_date, posted_by) 
                VALUES(".$data['task_id'].", '".mysqli_real_escape_string($conn, $data['remarks'])."', '".$data['posted_date']."', '".$data['posted_by']."')";

        $result = mysqli_query($conn, $sql);

        return $result;    
    }

    function fetchComment($conn, $id) {
        $user = $_SESSION['currentuser'];

        $data = [];
        $sql = "SELECT esc.remarks, DATE_FORMAT(esc.posted_date, '%Y-%m-%d %h:%i %p') as posted_date, CONCAT(emp.FIRST_M, '. ', emp.MIDDLE_M, ' ', emp.LAST_M) as posted_by, emp.profile as profile, emp.EMP_N as postby_id
          FROM event_subtasks_comment esc
          LEFT JOIN tblemployeeinfo emp ON emp.EMP_N = esc.posted_by
          WHERE task_id = $id";
        
        $query = mysqli_query($conn, $sql);   

        while ($row = mysqli_fetch_assoc($query)) {
            $is_currentuser = false;
            
            if ($user == $row['postby_id']) {
                $is_currentuser = true;
            }

            $profile = 'images/logo.png'; 

            if (strpos($row['profile'], '.png') || strpos($row['profile'], '.jpg') || strpos($row['profile'], '.jpeg')) {
                $profile = $row['profile']; 
            }

            $data[] = [
                'remarks' => $row['remarks'],
                'posted_date' => $row['posted_date'],
                'posted_by' => $row['posted_by'],
                'profile' => $profile,
                'is_currentuser' => $is_currentuser
            ];
        };

        return json_encode($data);
    }
