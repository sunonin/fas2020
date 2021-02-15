<?php
session_start();
date_default_timezone_set('Asia/Manila');

require_once "../../connection.php";

    
    $program = $_GET['program'];
    $result = fetchEvents($program);

    echo $result;

function fetchEvents($filter='ALL') {

    $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    $events = [];

    $current_date = date('Y-m-d H:i:s');
    $sql = "SELECT 
                    events.id as event_id, 
                    events.title as title, 
                    CONCAT(te.FIRST_M, ' ', te.LAST_M)  as fname, 
                    te.EMP_N as emp_id, 
                    tp.DIVISION_N as division, 
                    DATE_FORMAT(events.start, '%Y-%m-%d %H:%i:%s') as date_start, 
                    DATE_FORMAT(events.end, '%Y-%m-%d %H:%i:%s') as date_end, 
                    te.PROFILE as profile, 
                    events.description as description,
                    events.priority as priority,
                    events.comments as comments,
                    events.is_new as is_new,
                    events.enp as no_participants,
                    events.code_series as act_code
                FROM events
                LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = events.office
                LEFT JOIN tblemployeeinfo te on te.EMP_N = events.postedby
                LEFT JOIN tbldesignation tbl_desg on tbl_desg.DESIGNATION_ID = te.DESIGNATION
                WHERE tp.DIVISION_M like '%CDD%'";
    
    if ($filter != 'ALL') {
        $sql .= " AND events.program = '".$filter."' ";
    }
    
    $sql .= "ORDER BY events.id DESC";  

    $query = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($query)) {     

        $participants = getParticipants($row['event_id']);

        $profile = $color = '';
   
        $date_start = new DateTime($row['date_start']);
        $date_end = new DateTime($row['date_end']);
        
        if ($current_date > $row['date_end']) {
            $status = 'Finished';
            // $color = '#70ed70';  
        } elseif ($current_date >= $row['date_start'] AND $current_date <= $row['date_end']) {
            $status = 'Ongoing';
            // $color = '#f3bc43';      
        } else {
            $status = 'Not yet Started';
            // $color = '#ed5555';  
        }

        if ($row['is_new']) {
            $status = 'No time selected';
            $color = '#b7b4b4'; 
        }

        $start_date = new DateTime($row['date_start']);
        $end_date = new DateTime($row['date_end']);

        if (strpos($row['profile'], '.png') || strpos($row['profile'], '.jpg') || strpos($row['profile'], '.jpeg')) {
            $profile = $row['profile']; 
        } else {
            $profile = 'images/logo.png'; 
        }

        $events[] = [
            'id' => $row['event_id'],
            'act_code' => $row['act_code'],
            'emp_id' => $row['emp_id'],
            'title' => $row['title'],
            'host' => $row['fname'],
            'division' => $row['division'],
            'date_start_f' => $start_date->format('F d, Y h:i a'),
            'date_end_f' => $end_date->format('F d, Y h:i a'),
            'date_start' => $start_date->format('F d, Y'),
            'date_end' => $end_date->format('F d, Y'),
            'time_start' => $start_date->format('h:i a'),
            'time_end' => $end_date->format('h:i a'),
            'profile' => $profile,
            'priority' => $row['priority'],
            'status' => $status,
            'color' => $color,
            'description' => $row['description'],
            'collaborators' => $participants['emps'],
            'row_count' => $participants['row_count'],
            'target_participants' => $row['no_participants'],
            'is_new' => $row['is_new']
        ];

    }

   
    return json_encode($events);
}

function getParticipants($id) {

    $conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
    $sql = "SELECT emp_id, CONCAT(emp_fname, '. ', emp_mname, ' ', emp_lname) as fname
            FROM event_collaborators WHERE event_id = ".$id."";

    $emp = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($emp, MYSQLI_ASSOC);
    $row_count = count($result);

    $emps = [];

    foreach ($result as $key=>$row) {     
        $emps[] = $row['emp_id'];
    }

    $data = ['row_count' => $row_count, 'emps' => json_encode($emps)];

    return $data;
}