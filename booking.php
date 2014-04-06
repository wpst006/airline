<?php include('includes/includefiles.php'); ?>
<?php include('includes/routeHelper.php'); ?>

<?php $pageTitle = "Booking"; ?>
<?php include('includes/header.php'); ?>

<style>
    #route_id_chosen{
        margin-top:5px;
    }

    .my-btn{
        width:200px;
    }
</style>

<?php
if (isset($_GET['route_id_main'])) {
    $route_id_main = $_GET['route_id_main'];
} else {
    $route_id_main = routeHelper::getFirstRouteID();
}
?>

<div id="selected_route_id" style="display:none;"><?php echo $route_id_main; ?></div>

<?php $route_id_main = routeHelper::getFirstRouteID(); ?>
<div class="row">
    <div class="col-md-12">
        <form role="form" id="booking" name="booking" action="booking.php" method="get" class="form-horizontal">                     

            <div class="form-group">
                <label class="col-sm-2 control-label">Route :</label>
                <div class="col-sm-10">
                    <?php
                    $route_sql = "SELECT * FROM routes " .
                            "ORDER BY route_id";
                    $route_result = mysql_query($route_sql) or die(mysql_error());
                    ?>
                    <select id="route_id_main" name="route_id_main" class="chosen-select">
                        <?php while ($row = mysql_fetch_array($route_result)) { ?>
                            <option value="<?php echo $row['route_id']; ?>"><?php echo $row['title']; ?></option>
                        <?php } ?>
                    </select>                    
                </div>                            
            </div>        
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10 text-right">                    
                    <button type="submit" name="submitted" id="btn-search" class="btn btn-default btn-primary my-btn">Search</button>
                    <a href="print_bookingAvailableByRouteID.php?route_id=<?php echo $route_id_main; ?>" class="btn btn-default btn-info my-btn">Print</a>
                </div>                            
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $_GET['mode'] = 'booking';
        ?>        
        <?php include('includes/flight-schedules.php'); ?>
    </div>
</div>

<script type="text/javascript">    
    $(document).ready(function(){
        $(".chosen-select").chosen({width: "100%"}); 
        
        if ($('#selected_route_id').length>0){
            $('#route_id_main').val($('#selected_route_id').html());
            $("#route_id_main").trigger("chosen:updated");
            $('#route_id').val($('#selected_route_id').html());
            $("#route_id").trigger("chosen:updated");
        }
        
    });
    
    /*
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
     */
</script>

<?php include('includes/footer.php'); ?>
