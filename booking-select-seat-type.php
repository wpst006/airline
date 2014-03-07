<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/scheduleHelper.php'); ?>
<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<?php
if ($isLoggedIn == false) {
    messageHelper::setMessage("You are not logged into the system. Please log in to continue.", MESSAGE_TYPE_INFO);
    header("Location:login.php");
    exit();
}
?>

<?php $pageTitle = "Booking (Select Seat Type)"; ?>

<?php include('includes/header.php'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php
        $scheduleData = scheduleHelper::getScheduleByScheduleID($_GET['schedule_id']);
        //var_dump($scheduleData);
        ?>
        <h3 class="panel-title"><?php echo $scheduleData[0]['route_title']; ?>&nbsp;(<?php echo $scheduleData[0]['flight_name']; ?>)</h3>
    </div>
    <div class="panel-body">
        <table id="seat-table">
            <thead>
            <th>Seat Type</th>
            <th>No of Seat (Available)</th>
            <th>Price</th>
            <th></th>
            </thead>
            <tbody>
                <?php
                $scheduleData = scheduleHelper::getSeatsInScheduleByScheduleID($_GET['schedule_id']);
                ?>
                <?php foreach ($scheduleData as $row) { ?>
                    <?php
                    $link = "addSeat.php?schedule_id=" . $row['schedule_id'] .
                            "&seat_id=" . $row['seat_id'] .
                            "&seattype_id=" . $row['seattype_id'] .
                            "&seat_type=" . $row['seattype_title'] .
                            "&price=" . $row['price'] .
                            "&action=add2cart";
                    ?>
                    <tr>
                        <td><?php echo $row['seattype_title']; ?></td>
                        <td><?php echo $row['no_of_seat']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td class="action-column"><a href="<?php echo $link; ?>">Select Seat Type</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#seat-table').dataTable( {
            //"sPaginationType": "bootstrap",
            //"sPaginationType": "full_numbers",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        });                       
    });
</script>

<?php include('includes/footer.php'); ?>
