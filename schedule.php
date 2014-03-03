<?php include('includes/includefiles.php'); ?>
<?php require_once("includes/routeHelper.php"); ?>
<?php require_once("includes/flightHelper.php"); ?>
<?php require_once("includes/scheduleHelper.php"); ?>

<?php
if (isset($_POST['submitted'])) {
    //var_dump($_POST);exit();
    //*********************************************************************
    //Filling Data
    if (isset($_POST['schedule_id'])) {
        $schedule_id = $_POST['schedule_id'];
    } else {
        $schedule_id = autoID::getAutoID('schedules', 'schedule_id', 'SCH_', 6);
    }

    $flight_id = $_POST['flight_id'];
    $route_id = $_POST['route_id'];
    $departure_datetime = $_POST['departure_datetime'];
    $arrival_datetime = $_POST['arrival_datetime'];
    $departure_airport = $_POST['departure_airport'];
    $arrival_airport = $_POST['arrival_airport'];
    $remark = $_POST['remark'];
    //*********************************************************************
    $departure_datetime_string = date('Y-m-d H:i:00', strtotime($departure_datetime));
    $arrival_datetime_string = date('Y-m-d H:i:00', strtotime($arrival_datetime));
    //*********************************************************************
    if (isset($_POST['schedule_id'])) {
        //"schedules" Table Update
        $schedule_sql = "Update " .
                "schedules " . 
                "SET departure_datetime='" . $departure_datetime_string . "', " .
                "arrival_datetime='" . $arrival_datetime_string . "', " .
                "departure_airport='" . $departure_airport . "', " .
                "arrival_airport='" . $arrival_airport . "', " .
                "remark='" . $remark . "' " .
                "WHERE schedule_id='" . $schedule_id . "'";
    } else {
        //"schedules" Table Insert
        $schedule_sql = "INSERT INTO " .
                "schedules(schedule_id,flight_id,route_id,departure_datetime,arrival_datetime,departure_airport,arrival_airport,active,remark) " .
                "VALUES('$schedule_id','$flight_id','$route_id','$departure_datetime_string','$arrival_datetime_string','$departure_airport','$arrival_airport',1,'$remark')";
    }

    mysql_query($schedule_sql) or die(mysql_error());
    //*********************************************************************   
    messageHelper::setMessage("You have successfully add schedule.", MESSAGE_TYPE_SUCCESS);
    header("Location:route-detail-display.php?route_id=" . $_POST['route_id']);
    exit();
} else {
    $departure_datetime = date('Y-m-d h:i A', time());
    $arrival_datetime = date('Y-m-d h:i A', time());
    $departure_airport = "";
    $arrival_airport = "";
    $remark = "";
    $schedule_id = null;

    if (isset($_GET['schedule_id'])) {
        $schedule_id = $_GET['schedule_id'];

        $scheduleData = scheduleHelper::getScheduleByScheduleID($schedule_id);

        //var_dump($scheduleData);exit();
        $flight_id = $scheduleData[0]['flight_id'];
        $route_id = $scheduleData[0]['route_id'];
        $departure_datetime = $scheduleData[0]['departure_datetime'];
        $arrival_datetime = $scheduleData[0]['arrival_datetime'];
        $departure_airport = $scheduleData[0]['departure_airport'];
        $arrival_airport = $scheduleData[0]['arrival_airport'];
        $remark = $scheduleData[0]['remark'];
    } else {
        $flight_id = $_GET['flight_id'];
        $route_id = $_GET['route_id'];
    }
}
?>

<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="schedule" name="schedule" action="schedule.php" method="post" class="form-horizontal">         

            <?php if (isset($schedule_id)) { ?>
                <input type="hidden" id="schedule_id" name="schedule_id" value="<?php echo $schedule_id; ?>" />
            <?php } ?>

            <div class="form-group">
                <label class="col-sm-3 control-label">Flight :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo flightHelper::getFlightNameByFligthID($flight_id); ?></p>
                    <input type="hidden" id="flight_id" name="flight_id" value="<?php echo $flight_id; ?>" />
                </div>                            
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Route :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo routeHelper::getRouteTitleByRouteID($route_id); ?></p>
                    <input type="hidden" id="route_id" name="route_id" value="<?php echo $route_id; ?>" />
                </div>                            
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Departure Date :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="departure_datetime" name="departure_datetime" class="form-control" data-format="YYYY-MM-DD hh:mm A" value="<?php echo $departure_datetime; ?>"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Arrival Date :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="arrival_datetime" name="arrival_datetime" class="form-control" data-format="YYYY-MM-DD hh:mm A" value="<?php echo $arrival_datetime; ?>"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#departure_datetime').datetimepicker({
                    });
                    $('#arrival_datetime').datetimepicker({
                    });
                });
            </script>

            <div class="form-group">
                <div class="col-sm-3 control-label">Departure Airport :</div>
                <div class="col-sm-9">
                    <input type="text" id="departure_airport" name="departure_airport" class="form-control" value="<?php echo $departure_airport; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Arrival Airport :</div>
                <div class="col-sm-9">
                    <input type="text" id="arrival_airport" name="arrival_airport" class="form-control" value="<?php echo $arrival_airport; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Remark :</div>
                <div class="col-sm-9">
                    <textarea id="remark" name="remark" class="form-control" value="<?php echo $remark; ?>" rows="3"></textarea>                    
                </div>
            </div>            

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Save</button>
                    <button type="reset" name="reset"  class="btn btn-default">Reset</button>
                </div>                        
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">    
    $(document).ready(function(){        
    });
    
    $("#schedule").validate({
        rules: {            
            departure_airport: 
                {
                required: true
            },
            arrival_airport: 
                {
                required: true
            },            
        },
        //set messages to appear inline
        messages: 
            {
            departure_airport: "Please enter departure airport.",
            arrival_airport: "Please enter arrival airport.",             
        }
    });
</script>
<?php include('includes/footer.php'); ?>
