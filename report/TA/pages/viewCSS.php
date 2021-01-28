<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("../PHPJasperXML.inc.php");

function splitName($name){
    $names = explode(' ', $name);
    $lastname = $names[count($names) - 1];
    unset($names[count($names) - 1]);
    $firstname = join(' ', $names);
    return $firstname . ' ' . $lastname;
}

$conn=mysqli_connect('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');


if(mysqli_connect_errno()){echo mysqli_connect_error();}  
$cn = $_GET['CONTROL_NO'];


$query = "SELECT * FROM `tblcustomer_satisfaction_survey` INNER JOIN tblservice_dimension ON tblcustomer_satisfaction_survey.SD_ID = tblservice_dimension.CONTROL_NO WHERE tblcustomer_satisfaction_survey.`SD_ID` LIKE '%$cn%'";
$name = '';
$result = mysqli_query($conn, $query);
$val = array();
$rating_scale = '';
$service_dimension = '';
$service_provided = '';
$office = '';
$action_officer = '';
$list = array();
$sd = array();
while($row = mysqli_fetch_array($result))
{
    $office = $row['OFFICE'];
    $service_provided = $row['SERVICE_PROVIDED'];
    $action_officer = $row['ACTION_OFFICER'];
    $service_dimension = $row['SERVICE_DIMENTION'];
    $rating_scale = $row['RATING_SCALE'];
    $list[] = $row['RATING_SCALE'];
    $sd[] = $row['SERVICE_DIMENTION'];
}


foreach ($list as $list) {
   foreach ($sd as $sd){
// // $PHPJasperXML->debugsql=true;
$PHPJasperXML = new PHPJasperXML();
    if($list == 5 && $sd == 'Responsiveness')
    {
        $PHPJasperXML->arrayParameter=array(
            "office"=>$office,
            "service_provided"=>$service_provided,
            "action_officer"=>$action_officer,
            "rating_scale_res5"=>'black.png',
            "rating_scale_res4"=>'white.png',
            "rating_scale_res3"=>'white.png',
            "rating_scale_res2"=>'white.png',
            "rating_scale_res1"=>'white.png',
            "cn" => $cn,
        );
    }else if($list == 4  && $sd == 'Responsiveness')
    {
        $PHPJasperXML->arrayParameter=array(
            "office"=>$office,
            "service_provided"=>$service_provided,
            "action_officer"=>$action_officer,
            "rating_scale_res5"=>'white.png',
            "rating_scale_res4"=>'black.png',
            "rating_scale_res3"=>'white.png',
            "rating_scale_res2"=>'white.png',
            "rating_scale_res1"=>'white.png',
            "cn" => $cn,
        );
    }
    }
}

         
        
// switch($service_dimension)
//     {
       
//         case 'Responsiveness':
           
                
            
              
    //     break;
      


    // }



$PHPJasperXML->load_xml_file("survey_form.jrxml");
$PHPJasperXML->transferDBtoArray('localhost','fascalab_2020','w]zYV6X9{*BN','fascalab_2020');
    $PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
