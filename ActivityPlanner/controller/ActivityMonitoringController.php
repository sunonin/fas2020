<?php

require_once 'ActivityPlanner/manager/ActivityPlanner.php';

date_default_timezone_set('Asia/Manila');

// call instance of ActivityPlanner
// to access all method inside the class
$ap = new ActivityPlanner();

$username = $_SESSION['username'];
$userid = $_SESSION['currentuser'];

$task_count = $ap->fetchTasksStatusCount();
$lgcdd_emp = $ap->fetchEmployeeOptions2($userid);
$emp_opt = $ap->fetchEmployeeOptions();
$participants_opt = [
	'Regional Office' => 'Regional Office',
	'Provincial Office' => 'Provincial Office',
	'HUC' => 'HUC',
	'C/MLGOOs' => 'C/MLGOOs',
	'LGUs' => 'LGUs',
	'NGAs' => 'NGAs',
	'Others' => 'Others'
];

// LGCDD Activities
$lgcdd_events = fetchEvents($userid);

$lgcdd_programs = $ap->fetchRegisteredPrograms();
$cddprograms = $ap->fetchProgramCode();



function fetchEvents($currentuser='') {
	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$events = [];

	$ap = new ActivityPlanner();

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
				events.code_series as act_code,
				events.remarks as remarks
	    	FROM events
	        LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = events.office
	        LEFT JOIN tblemployeeinfo te on te.EMP_N = events.postedby
	        LEFT JOIN tbldesignation tbl_desg on tbl_desg.DESIGNATION_ID = te.DESIGNATION 
	        WHERE tp.DIVISION_M like '%CDD%' ORDER BY events.id DESC"; 	

	$query = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($query)) {

    	$participants = getParticipants($row['event_id']);
    	$co_hosts = getCoHost($currentuser, $row['event_id']);
    
    	$profile = $color = '';
   
    	$date_start = new DateTime($row['date_start']);
    	$date_end = new DateTime($row['date_end']);
    	
    	if ($current_date > $row['date_end']) {
    		$status = 'Finished';
    	} elseif ($current_date >= $row['date_start'] AND $current_date <= $row['date_end']) {
    		$status = 'Ongoing';	
    	} else {
    		$status = 'Not yet Started';
    	}

    	if ($row['is_new']) {
    		$status = 'No time selected';
			$color = '#f09e9e';	
    	}


    	if ($status != 'Finished') {
    		$start_date = new DateTime($row['date_start']);
	 		$end_date = new DateTime($row['date_end']);

	 		if (strpos($row['profile'], '.png') || strpos($row['profile'], '.jpg') || strpos($row['profile'], '.jpeg') || strpos($row['profile'], '.JPG')) {
				$profile = $row['profile']; 
	 		} else {
				$profile = 'images/logo.png'; 
	 		}

	 		$access_list = [];
	 		$has_access = false;

	 		if ($row['emp_id'] == $currentuser) {
	 			$access_list = fetchUserAccess($row['event_id'], $currentuser);
	 			$is_opr = $ap->isOPR($row['event_id'], $row['emp_id']);

	 			if ($is_opr OR in_array('opr', $access_list)) {
	 				$has_access = true;
	 			}
	 		}

	 		// $tgt_participants = explode(', ', $row['remarks']);
	 		$priority_label = priorityChecker($row['priority']);

	 		$events[] = [
	 			'id' => $row['event_id'],
	 			'act_code' => $row['act_code'],
	 			'emp_id' => $row['emp_id'],
	 			'title' => mb_strimwidth($row['title'], 0, 45, "..."),
	 			'host' => $row['fname'],
	 			'division' => $row['division'],
	 			'date_start_f' => $start_date->format('F d, Y h:i A'),
	 			'date_end_f' => $end_date->format('F d, Y h:i A'),
	 			'date_start' => $start_date->format('F d, Y'),
	 			'date_end' => $end_date->format('F d, Y'),
	 			'time_start' => $start_date->format('h:i A'),
	 			'time_end' => $end_date->format('h:i A'),
	 			'profile' => $profile,
	 			'priority' => $row['priority'],
	 			'priority_label' => $priority_label,
	 			'status' => $status,
	 			'color' => $color,
	 			'description' => $row['description'],
	 			'collaborators' => $participants['emps'],
	 			'row_count' => $participants['row_count'],
	 			'target_participants' => $row['no_participants'],
	 			'is_new' => $row['is_new'],
	 			'has_access' => $has_access,
	 			'tgt_participants' => json_encode(explode(', ', $row['remarks'])),
	 			'co_hosts' => json_encode(explode(', ', $co_hosts))
	 		];	
    	} 		
    }

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
				events.code_series as act_code,
				events.remarks as remarks
	    	FROM events
	        LEFT JOIN tblpersonneldivision tp on tp.DIVISION_N = events.office
	        LEFT JOIN tblemployeeinfo te on te.EMP_N = events.postedby
	        LEFT JOIN tbldesignation tbl_desg on tbl_desg.DESIGNATION_ID = te.DESIGNATION 
	        WHERE tp.DIVISION_M like '%CDD%' ORDER BY events.priority DESC, events.id DESC"; 	

	$query = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($query)) {

    	$participants = getParticipants($row['event_id']);
    	$co_hosts = getCoHost($currentuser, $row['event_id']);
    
    	$profile = $color = '';
   
    	$date_start = new DateTime($row['date_start']);
    	$date_end = new DateTime($row['date_end']);
    	
    	if ($current_date > $row['date_end']) {
    		$status = 'Finished';
    	} elseif ($current_date >= $row['date_start'] AND $current_date <= $row['date_end']) {
    		$status = 'Ongoing';	
    	} else {
    		$status = 'Not yet Started';
    	}

    	if ($row['is_new']) {
    		$status = 'No time selected';
			$color = '#f09e9e';	
    	}
    	if ($status == 'Finished') {
    		$start_date = new DateTime($row['date_start']);
	 		$end_date = new DateTime($row['date_end']);

	 		if (strpos($row['profile'], '.png') || strpos($row['profile'], '.jpg') || strpos($row['profile'], '.jpeg') || strpos($row['profile'], '.JPG')) {
				$profile = $row['profile']; 
	 		} else {
				$profile = 'images/logo.png'; 
	 		}

	 		$access_list = [];
	 		$has_access = false;

	 		if ($row['emp_id'] == $currentuser) {
	 			$access_list = fetchUserAccess($row['event_id'], $currentuser);
	 			$is_opr = $ap->isOPR($row['event_id'], $row['emp_id']);

	 			if ($is_opr OR in_array('opr', $access_list)) {
	 				$has_access = true;
	 			}
	 		}

	 		// $tgt_participants = explode(', ', $row['remarks']);
	 		$priority_label = priorityChecker($row['priority']);

	 		$events[] = [
	 			'id' => $row['event_id'],
	 			'act_code' => $row['act_code'],
	 			'emp_id' => $row['emp_id'],
	 			'title' => mb_strimwidth($row['title'], 0, 45, "..."),
	 			'host' => $row['fname'],
	 			'division' => $row['division'],
	 			'date_start_f' => $start_date->format('F d, Y h:i A'),
	 			'date_end_f' => $end_date->format('F d, Y h:i A'),
	 			'date_start' => $start_date->format('F d, Y'),
	 			'date_end' => $end_date->format('F d, Y'),
	 			'time_start' => $start_date->format('h:i A'),
	 			'time_end' => $end_date->format('h:i A'),
	 			'profile' => $profile,
	 			'priority' => $row['priority'],
	 			'priority_label' => $priority_label,
	 			'status' => $status,
	 			'color' => $color,
	 			'description' => $row['description'],
	 			'collaborators' => $participants['emps'],
	 			'row_count' => $participants['row_count'],
	 			'target_participants' => $row['no_participants'],
	 			'is_new' => $row['is_new'],
	 			'has_access' => $has_access,
	 			'tgt_participants' => json_encode(explode(', ', $row['remarks'])),
	 			'co_hosts' => json_encode(explode(', ', $co_hosts))
	 		];	
    	} 		
    }

    return $events;
}

function priorityChecker($num) {
	$txt = '';
	switch ($num) {
		case '1':
			$txt = 'Low Priority';
			break;
		case '2':
			$txt = 'Normal Priority';
			break;
		case '3':
			$txt = 'Medium Priority';
			break;
		case '4':
			$txt = 'High Priority';
			break;
		case '5':
			$txt = 'Urgent Priority';
			break;
	}

	return $txt;
}

function fetchUserAccess($id='', $user='') {
	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$checker = true;
	$access = [];
	
	$sql = "SELECT acl FROM event_collaborators
	  WHERE event_id = $id AND emp_id = $user";
	
	$query = mysqli_query($conn, $sql);	
	$row = mysqli_fetch_assoc($query);

	if (!empty($row)) {
		$acl = json_decode($row['acl']);
		foreach ($acl as $key => $value) {
			if ($value) {
				array_push($access, $key);
			}
		}
	}

	return $access;
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

function getCoHost($currentuser, $id) {

	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$sql = "SELECT emp_id, CONCAT(emp_fname, ' ',emp_lname) as fname, acl as acl
			FROM event_collaborators WHERE event_id = ".$id." AND emp_id <> $currentuser";


	$emp = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($emp, MYSQLI_ASSOC);
    $emps = [];

    foreach ($result as $key=>$row) {   
    	$acl = json_decode($row['acl'], true);
    	if ($acl["opr"]) {
    		$emps[] = $row['fname'];
    	}
    }

    return implode(', ', $emps);
}
