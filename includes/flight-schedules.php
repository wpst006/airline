<?php require_once('includes/routeHelper.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<style>
    .flight-name{
        font-weight: bold;
        font-size: 24pt;
        padding:0px;
        margin:0px;
    }
</style>
<?php
//***************************************************************************************************************************
$route_id = null;

if (isset($_GET['route_id'])) {
    $route_id = $_GET['route_id'];
} else {
//Getting first "route_id"
    $route_id = routeHelper::getFirstRouteID();
}

if (!isset($route_id)) {
    exit();
}

//***************************************************************************************************************************
$mode = 'booking';

if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
}
//***************************************************************************************************************************
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        $delete_sql = "DELETE FROM schedules WHERE schedule_id='" . $_GET['schedule_id'] . "'";
        mysql_query($delete_sql) or die(mysql_error());
    }
}
//***************************************************************************************************************************

$flight_sql = "SELECT flights.*
            FROM flights
            WHERE flights.flight_id
            IN (
                SELECT schedules.flight_id
                FROM schedules
                WHERE route_id = '" . $route_id . "'
            )";

//print_r($sql);exit();
$flight_result = mysql_query($flight_sql) or die(mysql_error());
$noOfRows = mysql_num_rows($flight_result);

if ($noOfRows == 0) {
    ?>
    <div class="row">
        <div class="col-md-12">   
            <h2>No record found for selected Route.</h2>
        </div>
    </div>
<?php } else { ?>
    <?php while ($flightRow = mysql_fetch_array($flight_result)) { ?>
        <div class="row">
            <div class="col-md-12">            
                <p class="flight-name"><?php echo $flightRow['name']; ?></p>            
                <table class="schedule-table">
                    <thead>
                    <th>Departure Date Time</th>
                    <th>Arrival Date Time</th>
                    <th>Departure Airport</th>
                    <th>Arrival Airport</th>
                    <th></th>
                    </thead>
                    <tbody>
                        <?php
                        $schedule_sql = "SELECT * " .
                                "FROM schedules " .
                                "WHERE flight_id='" . $flightRow['flight_id'] . "' " .
                                "AND route_id='" . $route_id . "' " .
                                "AND active=1 " .
                                "ORDER BY schedule_id";
                        //print_r($sql);exit();
                        $schedule_result = mysql_query($schedule_sql) or die(mysql_error());
                        ?>
                        <?php while ($row = mysql_fetch_array($schedule_result)) { ?>
                            <tr>                        
                                <td><?php echo $row['departure_datetime']; ?></td>
                                <td><?php echo $row['arrival_datetime']; ?></td>
                                <td><?php echo $row['departure_airport']; ?></td>
                                <td><?php echo $row['arrival_airport']; ?></td>
                                <?php
                                $objLogIn = new logIn();
                                $isAdminLogIn = $objLogIn->isAdminLogIn();

                                if ($isAdminLogIn == true) {
                                    $mode = "admin";
                                }

                                $link = '#';
                                $linkText = "...";

                                if ($mode == 'display') {
                                    $link = "schedule.php?route_id=" . $route_id .
                                            "&flight_id=" . $flightRow['flight_id'];
                                    $linkText = "Add Schedule";
                                } else if ($mode == 'booking') {
                                    $link = "booking-select-seat-type.php?schedule_id=" . $row['schedule_id'];
                                    $linkText = "Add Booking";
                                } else if ($mode == 'admin') {
                                    $link = "seat-setup.php?schedule_id=" . $row['schedule_id'];
                                    $linkText = "Seat SetUp";
                                }
                                ?>
                                <td class="text-right">
                                    <a href="<?php echo $link; ?>"><?php echo $linkText; ?></a>
                                    <?php
                                    if ($mode == 'admin') {
                                        $editLink = "schedule.php?schedule_id=" . $row['schedule_id'] . "&route_id=" . $route_id .
                                                "&flight_id=" . $flightRow['flight_id'];
                                        ?>
                                        &nbsp;<a href="<?php echo $editLink; ?>">Edit</a>
                                        &nbsp;<a href="booking.php?schedule_id=<?php echo $row['schedule_id']; ?>&action=delete" class="delete-link">Delete</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php }//end of inner "while" loop ?>
                    </tbody>                
                </table>
                <?php
                $addScheduleLink = "schedule.php?route_id=" . $route_id .
                        "&flight_id=" . $flightRow['flight_id'];
                ?>
                <a href="<?php echo $addScheduleLink; ?>" class="btn btn-primary pull-right">Add Schedule</a>
                <br/>
            </div>
        </div>
    <?php }//end of outer "while" loop ?>
<?php }//end of "if" ?>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.schedule-table').dataTable( {
            //"sPaginationType": "bootstrap",
            //"sPaginationType": "full_numbers",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        });     
        
        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the schedule?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>