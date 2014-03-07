<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/flightHelper.php'); ?>

<?php
if (isset($_POST['submitted'])) {
    //*********************************************************************
    //Filling Data
    if (isset($_POST['flight_id'])) {
        $flight_id = $_POST['flight_id'];
    } else {
        $flight_id = autoID::getAutoID('flights', 'flight_id', 'FLH_', 6);
    }
    $title = $_POST['name'];
    $remark = $_POST['remark'];
    //*********************************************************************
    if (isset($_POST['flight_id'])) {
        //"flights" Table Update
        $flight_sql = "UPDATE " .
                "flights SET " .
                "name='" . $title . "'," .
                "remark='" . $remark . "' " .
                "WHERE flight_id='" . $flight_id . "'";
    } else {
        //"flights" Table Insert
        $flight_sql = "INSERT INTO " .
                "flights(flight_id,name,remark) " .
                "VALUES('$flight_id','$title','$remark')";
    }

    mysql_query($flight_sql) or die(mysql_error());
    //*********************************************************************    
    messageHelper::setMessage("You have successfully save flight.", MESSAGE_TYPE_SUCCESS);
    header("Location:flights.php");
    exit();
}

$flight_id = null;
$title = "";
$remark = "";


if (isset($_GET['flight_id'])) {
    $flight_id = $_GET['flight_id'];

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'delete') {
            $flight_sql = "DELETE FROM flights WHERE flight_id='" . $flight_id . "'";
        }

        mysql_query($flight_sql) or die(mysql_error());
        //*********************************************************************    
        messageHelper::setMessage("You have successfully delete flight.", MESSAGE_TYPE_SUCCESS);
        header("Location:flights.php");
        exit();
    }

    $routeData = flightHelper::getFlightByFligthID($flight_id);
    $title = $routeData[0]['name'];
    $remark = $routeData[0]['remark'];
}
?>

<?php $pageTitle = "Flights"; ?>

<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="flights" name="flights" action="flights.php" method="post" class="form-horizontal">

            <?php if (isset($flight_id)) { ?>
                <input type="hidden" id="flight_id" name="flight_id" value="<?php echo $flight_id; ?>" />
            <?php } ?>

            <div class="form-group">
                <div class="col-sm-3 control-label">Flight Name :</div>
                <div class="col-sm-9">
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $title; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Remark :</div>
                <div class="col-sm-9">
                    <textarea id="remark" name="remark" class="form-control"><?php echo $remark; ?></textarea>
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

<?php include('includes/flight-display.php'); ?>

<script type="text/javascript">
    $("#flights").validate({
        rules: {
            name: 
                {
                required: true
            },            
        },
        //set messages to appear inline
        messages: 
            {
            name: "Please enter flight name.",
        }
    });
</script>
<?php include('includes/footer.php'); ?>
