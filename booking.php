<?php include('includes/includefiles.php'); ?>
<?php include('includes/header.php'); ?>

<?php if (isset($_POST['route_id'])) { ?>
    <div id="selected_route_id" style="display:none;"><?php echo $_POST['route_id']; ?></div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <form role="form" id="booking" name="booking" action="booking.php" method="post" class="form-horizontal">                     
            
            <div class="form-group">
                <label class="col-sm-3 control-label">Route :</label>
                <div class="col-sm-9">
                    <?php
                    $route_sql = "SELECT * FROM routes " .
                            "ORDER BY title";
                    $route_result = mysql_query($route_sql) or die(mysql_error());
                    ?>
                    <select id="route_id" name="route_id" class="chosen-select">
                        <?php while ($row = mysql_fetch_array($route_result)) { ?>
                            <option value="<?php echo $row['route_id']; ?>"><?php echo $row['title']; ?></option>
                        <?php } ?>
                    </select>
                </div>                            
            </div>                                   

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" name="submitted" class="btn btn-default btn-primary">Search</button>
                </div>                        
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php if (isset($_POST['route_id'])){
            $_GET['route_id']=$_POST['route_id'];
        }
        $_GET['mode']='booking';
        ?>        
        <?php include('includes/flight-schedules.php'); ?>
    </div>
</div>

<script type="text/javascript">    
    $(document).ready(function(){
        $(".chosen-select").chosen({width: "95%"}); 
        
        if ($('#selected_route_id').length>0){
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