<?php include('includes/includefiles.php'); ?>
<?php include('includes/header.php'); ?>
<?php require_once("includes/routeHelper.php"); ?>

<h2><?php echo routeHelper::getRouteTitleByRouteID($_GET['route_id']); ?></h2>
        
<?php include('includes/flight-schedules.php'); ?>

<?php include('includes/footer.php'); ?>
