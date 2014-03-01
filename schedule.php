<?php include('includes/includefiles.php'); ?>
<?php require_once("includes/routeHelper.php"); ?>
<?php require_once("includes/flightHelper.php"); ?>

<?php
if (isset($_POST['submitted'])) {
    //var_dump($_POST);exit();
    
    //*********************************************************************
    //Filling Data
    $seat_id = autoID::getAutoID('schedules', 'schedule_id', 'SCH_', 6);
    $flight_id = $_POST['flight_id'];
    $route_id = $_POST['route_id'];
    $departure_datetime = $_POST['departure_datetime'];
    $arrival_datetime = $_POST['arrival_datetime'];
    $departure_airport = $_POST['departure_airport'];
    $arrival_airport = $_POST['arrival_airport'];
    $remark = $_POST['remark'];
    //*********************************************************************
    $departure_datetime_string=date('Y-m-d H:i:00',strtotime($departure_datetime));
    $arrival_datetime_string=date('Y-m-d H:i:00',strtotime($arrival_datetime));
    //"schedules" Table Insert
    $scheduleInsert_sql = "INSERT INTO " .
            "schedules(schedule_id,flight_id,route_id,departure_datetime,arrival_datetime,departure_airport,arrival_airport,active,remark) " .
            "VALUES('$seat_id','$flight_id','$route_id','$departure_datetime_string','$arrival_datetime_string','$departure_airport','$arrival_airport',1,'$remark')";

    mysql_query($scheduleInsert_sql) or die(mysql_error());
    //*********************************************************************   
    messageHelper::setMessage("You have successfully add schedule.", MESSAGE_TYPE_SUCCESS);
    header("Location:route-detail-display.php?route_id=" . $_POST['route_id']);
    exit();
}
?>

<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="schedule" name="schedule" action="schedule.php" method="post" class="form-horizontal">         

            <div class="form-group">
                <label class="col-sm-3 control-label">Flight :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo flightHelper::getFlightNameByFligthID($_GET['flight_id']); ?></p>
                    <input type="hidden" id="flight_id" name="flight_id" value="<?php echo $_GET['flight_id']; ?>" />
                </div>                            
            </div>
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Route :</label>
                <div class="col-sm-9">
                    <p class="form-control-static"><?php echo routeHelper::getRouteTitleByRouteID($_GET['route_id']); ?></p>
                    <input type="hidden" id="route_id" name="route_id" value="<?php echo $_GET['route_id']; ?>" />
                </div>                            
            </div>
            
            <div class="form-group">
                <div class="col-sm-3 control-label">Departure Date :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="departure_datetime" name="departure_datetime" class="form-control" data-format="YYYY-MM-DD hh:mm A" value="<?php echo date('Y-m-d h:i A', time()); ?>"/>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Arrival Date :</div>
                <div class="col-sm-9">
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' id="arrival_datetime" name="arrival_datetime" class="form-control" data-format="YYYY-MM-DD hh:mm A" value="<?php echo date('Y-m-d h:i A', time()); ?>"/>
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
                    <input type="text" id="departure_airport" name="departure_airport" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Arrival Airport :</div>
                <div class="col-sm-9">
                    <input type="text" id="arrival_airport" name="arrival_airport" class="form-control" value="" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Remark :</div>
                <div class="col-sm-9">
                    <textarea id="remark" name="remark" class="form-control" rows="3"></textarea>                    
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
