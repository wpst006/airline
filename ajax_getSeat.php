<?php header('Content-Type: application/json'); ?>
<?php include('includes/includefiles.php'); ?>
<?php

$sql = "SELECT * FROM seats " .
        "WHERE schedule_id='" . $_GET['schedule_id'] . "' " .
        "AND seattype_id='" . $_GET['seattype_id'] . "' " .
        "ORDER BY seat_id";
$result = mysql_query($sql) or die(mysql_error());

$noOfRows = mysql_num_rows($result);

if ($noOfRows == 0) {
    echo ajaxHelper::responseSuccess();
} else {
    $data = mysql_fetch_array($result);
    $output = array(
        'seat_id' => $data['seat_id'],
        'schedule_id' => $data['schedule_id'],
        'seattype_id' => $data['seattype_id'],
        'no_of_seat' => $data['no_of_seat'],
        'price' => $data['price'],
    );
    echo ajaxHelper::responseSuccess($output);
}
?>
