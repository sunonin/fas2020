<?php 

$conn = mysqli_connect("localhost","fascalab_2020","w]zYV6X9{*BN","fascalab_2020");

$userId = $_GET['userId'];
$username = $_GET['username'];
$menuIdHolder = $_GET['menuIdHolder'];
$menuIdHolder = rtrim($menuIdHolder, ',');
$menuIdHolder = ltrim($menuIdHolder, ',');

$subject =  $menuIdHolder;
$pattern = '/\b([^,]*45[^,]*)\b/';
preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
foreach ($matches as $val) {
    $po_admin = $val[1]; 
}
if(isset($po_admin))
{
	$selectIfExisting = ' SELECT `id` FROM `tbl_module_access` WHERE `user_id` = '.$userId.' ';
	$execIfExisting = $conn->query($selectIfExisting);
	if ($execIfExisting->num_rows>0)
	{
		$sql = ' UPDATE `tbl_module_access` SET `module_id` = "'.$menuIdHolder.'", `moderator_username` = "'.$username.'", `date_updated` = NOW(), `access_type` = 2 WHERE `user_id` = '.$userId.' ';
	}
	else
	{
		$sql = ' INSERT INTO `tbl_module_access`(`user_id`, `module_id`, `moderator_username`, `date_updated`) VALUES ("'.$userId.'", "'.$menuIdHolder.'", "'.$username.'", NOW()) ';
	}

	$exec = $conn->query($sql);
	echo "success";

}else{
	$selectIfExisting = ' SELECT `id` FROM `tbl_module_access` WHERE `user_id` = '.$userId.' ';
	$execIfExisting = $conn->query($selectIfExisting);
	if ($execIfExisting->num_rows>0)
	{
		$sql = ' UPDATE `tbl_module_access` SET `module_id` = "'.$menuIdHolder.'", `moderator_username` = "'.$username.'", `date_updated` = NOW(), `access_type` = 0 WHERE `user_id` = '.$userId.' ';
	}
	else
	{
		$sql = ' INSERT INTO `tbl_module_access`(`user_id`, `module_id`, `moderator_username`, `date_updated`) VALUES ("'.$userId.'", "'.$menuIdHolder.'", "'.$username.'", NOW()) ';
	}

	$exec = $conn->query($sql);
	echo "success";


}




 ?>