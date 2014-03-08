<?php

class routeHelper {

    public static function getRouteTitleByRouteID($route_id) {
        $title = null;

        $sql = "SELECT * " .
                "FROM routes " .
                "WHERE route_id='" . $route_id . "' " .
                "ORDER BY title";
        $result = mysql_query($sql) or die(mysql_error());

        while ($row = mysql_fetch_array($result)) {
            $title = $row['title'];
        }

        return $title;
    }

    public static function getRouteByRouteID($route_id) {

        $sql = "SELECT * " .
                "FROM routes " .
                "WHERE route_id='" . $route_id . "' " .
                "ORDER BY title";
        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'route_id' => $row['route_id'],
                'title' => $row['title'],
                'hour' => $row['hour'],
                'min' => $row['min'],
                'remark'=> $row['remark']
            );
        }

        return $output;
    }

    public static function selectAll() {

        $sql = "SELECT * " .
                "FROM routes " .
                "ORDER BY title";
        $result = mysql_query($sql) or die(mysql_error());

        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'route_id' => $row['route_id'],
                'title' => $row['title'],
                'hour' => $row['hour'],
                'min' => $row['min'],
                'remark'=> $row['remark']
            );
        }

        return $output;
    }

    public static function getFirstRouteID() {
        $route_id = null;

        $sql = "SELECT * " .
                "FROM routes " .
                "ORDER BY route_id";
        $result = mysql_query($sql) or die(mysql_error());

        while ($row = mysql_fetch_array($result)) {
            $route_id = $row['route_id'];
            break;
        }

        return $route_id;
    }

    public static function getFlightsByRouteID($route_id){
        $sql = "SELECT flights.*
            FROM flights
            WHERE flights.flight_id
            IN (
                SELECT schedules.flight_id
                FROM schedules
                WHERE route_id = '" . $route_id . "'
            )";

        $result = mysql_query($sql) or die(mysql_error());
        $noOfRows=  mysql_num_rows($result);
        
        if ($noOfRows==0){
            return null;
        }
        
        $output = array();

        while ($row = mysql_fetch_array($result)) {
            $output[] = array(
                'flight_id' => $row['flight_id'],
                'name' => $row['name'],
                'remark'=> $row['remark']
            );
        }

        return $output;
    }
}

?>