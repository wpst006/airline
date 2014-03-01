<?php include('includes/includefiles.php'); ?>
<?php include('includes/header.php'); ?>

<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    
<div class="row">
    <div class="col-md-12">
        <table id="route-table">
            <thead>
            <th>Route</th>            
            <th></th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * " .
                        "FROM routes " .
                        "ORDER BY title";
                //print_r($sql);exit();
                $result = mysql_query($sql) or die(mysql_error());
                ?>
                <?php while ($row = mysql_fetch_array($result)) { ?>
                    <tr>                        
                        <td><?php echo $row['title']; ?></td>                        
                        <td><a href="route-detail-display.php?route_id=<?php echo $row['route_id']; ?>">Route Detail</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="js/datatable/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#route-table').dataTable( {
            //"sPaginationType": "bootstrap",
            "sPaginationType": "full_numbers",
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
        });                       
    });
</script>

<?php include('includes/footer.php'); ?>
