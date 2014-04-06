<link href="css/jquery.dataTables.css" rel="stylesheet" type="text/css" />

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Routes</h3>
  </div>
  <div class="panel-body">
    <table id="route-table">
            <thead>
            <th>Route</th>
            <th>Duration</th>
            <th></th>
            </thead>
            <tbody>
                <?php
                $flightData= routeHelper::selectAll();
                ?>
                <?php foreach ($flightData as $row) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>                        
                        <td><?php echo $row['hour'] . ":" . $row['min']; ?></td>   
                        <td class="action-column">
                            <a href="routes.php?route_id=<?php echo $row['route_id'];?>">Edit</a>
                            <a href="routes.php?route_id=<?php echo $row['route_id'];?>&action=delete" class="delete-link">Delete</a>
                        </td>
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
            //"sPaginationType": "full_numbers",
            "bPaginate": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
        } );
        
        $( ".delete-link" ).click(function( event ) {
            if (window.confirm("Are you sure want to delete the flight?")==true){
                return true;
            }else{
                event.preventDefault();
                return false;
            }
        });
    });
</script>