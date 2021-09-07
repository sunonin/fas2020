<?php
date_default_timezone_set('Asia/Manila');

$event_id = $_GET['event_planner_id'];
$user = $_SESSION['currentuser'];
$collaborators = fetchEventCollaborators();
$collaborators1 = fetchEventCollaborators1();
$subtasks = fetchData();
$event_data = fetchEvent();
$is_opr = isOPR($event_id, $user);
$access_list = fetchUserAccess($event_id, $user);

function hasAccess($pointer='') {
	$checker = false;
	$access_list = fetchUserAccess($event_id, $user);

	if (in_array($pointer, $access_list)) {
		$checker = true;	
	}

	return $checker;
}

function isOPR($id='', $user='') {
	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$checker = true;
	$sql = "SELECT * FROM events
	  WHERE id = $id AND postedby = $user";

	$query = mysqli_query($conn, $sql);	
	$row = mysqli_fetch_assoc($query);

	if (empty($row)) {
		$checker = false;
	}

	return $checker;
}

function fetchUserAccess($id='', $user='') {
	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$checker = true;
	$sql = "SELECT acl FROM event_collaborators
	  WHERE event_id = $id AND emp_id = $user";
	
	$query = mysqli_query($conn, $sql);	
	$row = mysqli_fetch_assoc($query);

	$acl = json_decode($row['acl']);
	$access = [];
	foreach ($acl as $key => $value) {
		if ($value) {
			array_push($access, $key);
		}
	}

	return $access;
}

function fetchEventCollaborators1() {

	$id = $_GET['event_planner_id'];

	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$employees = [];
	$sql = "SELECT ec.id as clb_id, ec.emp_id as emp_id, ec.emp_fname as fname, ec.emp_mname as mname, ec.emp_lname as lname, ec.acl as acl
	  FROM event_collaborators ec
	  WHERE ec.event_id = $id";
	  
	$query = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($query)) {
	 	$emp_id = $row["emp_id"];
		$fname = $row['fname'];  
	  	$mname = $row["mname"];  
	  	$lname = $row["lname"];
		
		$employees[$row['clb_id']] = [
			'emp_id' => $row['emp_id'],
			'name' => $row['fname'] .' '. $row["mname"] .'. ' .$row["lname"],
			'acl' => json_decode($row['acl'])
		];
	} 

	return $employees;  
}

function fetchEventCollaborators() {

	$id = $_GET['event_planner_id'];

	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$employees = [];
	$sql = "SELECT ec.emp_id as emp_id, ec.emp_fname as fname, ec.emp_mname as mname, ec.emp_lname as lname
	  FROM event_collaborators ec
	  WHERE ec.event_id = $id";
	  
	$query = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($query)) {
	 	$emp_id = $row["emp_id"];
		$fname = utf8_encode($row['fname']);  
	  	$mname = utf8_encode($row["mname"]);  
	  	$lname = utf8_encode($row["lname"]);
		
		$employees[$row['emp_id']] = $row['fname'] .' '. $row["mname"] .'. ' .$row["lname"];
	} 

	return $employees;  
}

function fetchEvent() {
	$id = $_GET['event_planner_id'];

	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

	$query = "SELECT 
		ev.id as id, 
		ev.title as event_title, 
		ev.description as event_description, 
		ev.venue as event_venue, 
		-- DATE_FORMAT(ev.start, '%M %d, %Y %h:%i %p') as event_start, 
		-- DATE_FORMAT(ev.end, '%M %d, %Y %h:%i %p') as event_end,
		ev.start as event_start, 
		ev.end as event_end, 
		emp.FIRST_M as emp_fname, 
		emp.MIDDLE_M as emp_mname, 
		emp.LAST_M as emp_lname, 
		emp.FIRST_M as fname, 
		emp.LAST_M as lname, 
		emp.PROFILE as event_profile, 
		desg.DESIGNATION_M as host_designation, 
		ev.priority as event_priority, 
		ev.code_series as code_series, 
		ev.program as event_program, 
		ev.remarks as target_participants
	  FROM events ev
	  LEFT JOIN tblemployeeinfo emp on emp.EMP_N = ev.postedby
	  LEFT JOIN tbldesignation desg on desg.DESIGNATION_ID = emp.DESIGNATION
	  WHERE ev.id = $id";

	$result = mysqli_query($conn, $query);
	$data = [];

    while ($row = mysqli_fetch_assoc($result)) {     
		$profile = $row['event_profile']; 
		$date_start = new DateTime($row['event_start']);
    	$date_end = new DateTime($row['event_end']);

    	if (!strpos($profile, '.png') AND !strpos($profile, '.jpg') AND !strpos($profile, '.jpeg')) {
			$profile = 'images/logo.png'; 
 		}

 		$host_name = $row['emp_fname'] .' '. substr($row['emp_mname'], 0, 1) .'. '. $row['emp_lname'];

 		$data = [
 			'id' => $row['id'],
 			'event_title' => $row['event_title'],
 			'event_program' => $row['event_program'],
 			'code_series' => $row['code_series'],
 			'event_description' => $row['event_description'],
 			'event_venue' => $row['event_venue'],
 			'host_name' => $host_name,
 			'host_initials' => $row['fname'][0] .''.$row['lname'][0],
 			'event_start' => date_format($date_start, 'M d, Y h:i A'),
 			'event_end' => date_format($date_end, 'M d, Y h:i A'),
 			'host_profile' => $profile,
 			'host_designation' => empty($row['host_designation']) ? 'Job Order' : $row['host_designation'],
 			'event_priority' => $row['event_priority'],
 			'current_user' => $_SESSION['currentuser'],
 			'target_participants' => $row['target_participants']
 		];
    };

	return $data;
}

function fetchData() {

	$id = $_GET['event_planner_id'];

	$conn=mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");
	$data = [];

	$sql = "SELECT 
		es.id as id, 
		es.emp_id as emp_id,
		es.title as title, 
		es.status as status, 
		DATE_FORMAT(es.date_from, '%m/%d/%Y %h:%i %p') as date_from, 
		DATE_FORMAT(es.date_to, '%m/%d/%Y %h:%i %p') as date_to,
		DATE_FORMAT(es.date_start, '%m/%d/%Y %h:%i %p') as date_start, 
		DATE_FORMAT(es.date_end, '%m/%d/%Y %h:%i %p') as date_end, 
		es.is_new as is_new,
		es.code as code,
		es.task_counter as task_counter,
		es.external_link as external_link
	  FROM event_subtasks es
	  WHERE es.event_id = $id";
	
	$query = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($query)) {
	 	$is_readonly = false;
	 	if (in_array($row['status'], ['Done', 'Ongoing', 'For Checking'])) {
	 		$is_readonly = true;
	 	}

	 	$persons = json_decode($row['emp_id'], true);
	 	$collaborators = fetchEmployee($conn, $persons);

	 	$comments = fetchComment($conn, $row['id']);

	 	$data[] = [
	 		'task_id' 		=> $row['id'],
	 		'task_code' 	=> $row['code'],
	 		'title' 		=> $row['title'],
	 		'emp_id' 		=> $row['emp_id'],
	 		'person' 		=> count($collaborators) > 1 ? implode(", <br>", $collaborators) : implode("<br>", $collaborators),
	 		'status' 		=> $row['status'] != "For Checking" ? lcfirst($row['status']) : "forchecking",
	 		'is_readonly' 	=> $is_readonly,
	 		'date_from' 	=> $row['date_from'],
	 		'date_to' 		=> $row['date_to'],
	 		'date_start' 	=> $row['date_start'] != '' ? $row['date_start'] : '',
	 		'date_end' 		=> $row['date_end'] != '' ? $row['date_end'] : '',
	 		'is_new' 		=> $row['is_new'],
	 		'comments' 		=> $comments,
			'task_counter' 	=> $row['task_counter'] > 0 ? $row['task_counter'] : '',
			'external_link' => $row['external_link']

	 	];	
	} 


	return $data;  
}

function fetchEmployee($conn, $data) {
	$dd = [];

	if (is_array($data)) {
		foreach ($data as $key => $id) {
			$sql = "SELECT LAST_M as lname, FIRST_M as fname
			  FROM tblemployeeinfo 
			  WHERE EMP_N = $id";

			$query = mysqli_query($conn, $sql);
			$result = mysqli_fetch_array($query);  
			$dd[] = $result['fname'] .' ' .$result['lname'];
		}
	} else {
		$sql = "SELECT LAST_M as lname, FIRST_M as fname
		  FROM tblemployeeinfo 
		  WHERE EMP_N = $data";

		$query = mysqli_query($conn, $sql);
		$result = mysqli_fetch_array($query);  
		$dd[] = $result['fname'] .' ' .$result['lname'];
	}

	return $dd;
}

function fetchComment($conn, $id) {
	$user = $_SESSION['currentuser'];
	$data = [];
	$sql = "SELECT esc.remarks, DATE_FORMAT(esc.posted_date, '%Y/%m/%d %H:%i:%s') as posted_date, CONCAT(emp.FIRST_M, '. ', emp.MIDDLE_M, ' ', emp.LAST_M) as posted_by, emp.profile as profile, emp.EMP_N as postby_id
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