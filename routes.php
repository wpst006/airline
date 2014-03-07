<?php include('includes/includefiles.php'); ?>
<?php require_once('includes/routeHelper.php'); ?>

<?php
if (isset($_POST['submitted'])) {
    //*********************************************************************
    //Filling Data
    if (isset($_POST['route_id'])) {
        $route_id = $_POST['route_id'];
    } else {
        $route_id = autoID::getAutoID('routes', 'route_id', 'ROU_', 6);
    }
    $title = $_POST['title'];
    $remark = $_POST['remark'];
    $hour=(int)$_POST['hour'];
    $min=(int)$_POST['min'];
    //*********************************************************************
    if (isset($_POST['route_id'])) {
        //"routes" Table Update
        $flight_sql = "UPDATE " .
                "routes SET " .
                "title='" . $title . "'," .
                "hour=" . $hour . "," .
                "min=" . $min . "," .
                "remark='" . $remark . "' " .
                "WHERE route_id='" . $route_id . "'";
    } else {
        //"routes" Table Insert
        $flight_sql = "INSERT INTO " .
                "routes(route_id,title,hour,min,remark) " .
                "VALUES('$route_id','$title',$hour,$min,'$remark')";
    }

    mysql_query($flight_sql) or die(mysql_error());
    //*********************************************************************    
    messageHelper::setMessage("You have successfully save Route.", MESSAGE_TYPE_SUCCESS);
    header("Location:routes.php");
    exit();
}

$route_id = null;
$title = "";
$remark = "";
$hour=0;
$min=0;

if (isset($_GET['route_id'])) {
    $route_id = $_GET['route_id'];

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'delete') {
            $flight_sql = "DELETE FROM routes WHERE route_id='" . $route_id . "'";
        }

        mysql_query($flight_sql) or die(mysql_error());
        //*********************************************************************    
        messageHelper::setMessage("You have successfully delete Route.", MESSAGE_TYPE_SUCCESS);
        header("Location:routes.php");
        exit();
    }

    $routeData = routeHelper::getRouteByRouteID($route_id);
    $title = $routeData[0]['title'];
    $hour = $routeData[0]['hour'];
    $min = $routeData[0]['min'];
    $remark = $routeData[0]['remark'];
}
?>

<?php $pageTitle = "routes"; ?>

<?php include('includes/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="routes" title="routes" action="routes.php" method="post" class="form-horizontal">

            <?php if (isset($route_id)) { ?>
                <input type="hidden" id="route_id" name="route_id" value="<?php echo $route_id; ?>" />
            <?php } ?>

            <div class="form-group">
                <div class="col-sm-3 control-label">Route :</div>
                <div class="col-sm-9">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $title; ?>" maxlength="30"/>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3 control-label">Duration (hour:min):</div>
                <div class="col-sm-9">                    
                    <select id="hour" name="hour" class="chosen-select">
                        <?php for ($i=0;$i<=12;$i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>&nbsp;:&nbsp;
                    <select id="min" name="min" class="chosen-select">
                        <?php for ($i=0;$i<=55;$i+=5) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" id="hour_selected" name="hour_selected" value="<?php echo $hour; ?>" />
                    <input type="hidden" id="min_selected" name="min_selected" value="<?php echo $min; ?>" />
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

<?php include('includes/route-display.php'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $(".chosen-select").chosen({width: "10%"});  
        
        $('#hour').val($('#hour_selected').val());            
        $("#hour").trigger("chosen:updated");
        $('#min').val($('#min_selected').val());            
        $("#min").trigger("chosen:updated");
        
    });
    
    $("#routes").validate({
        rules: {
            title: 
                {
                required: true
            },            
        },
        //set messages to appear inline
        messages: 
            {
            title: "Please enter route title.",
        }
    });
</script>
<?php include('includes/footer.php'); ?>
