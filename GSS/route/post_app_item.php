<?php
$procurement = $_GET['procurement'];

$result = fetchEvents($procurement);
echo $result;
function fetchEvents($param1)
{

    $conn = mysqli_connect("localhost", "fascalab_2020", "w]zYV6X9{*BN", "fascalab_2020");
    $data = [];

    $sql = "SELECT  id,price,sn,price,procurement,unit_id,app_year from app where app_year = '2022' and id = '" . $param1 . "' ";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $data = array(
            'id' => $row['id'],
            'price' => $row['price'],
            'sn' => $row['sn'],
            'procurement' => $row['procurement'],
            'unit_id' => $row['unit_id'],
            'app_year' => $row['app_year']
        );
          
    }
    return json_encode($data);
}