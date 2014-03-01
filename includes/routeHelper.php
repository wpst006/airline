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
            $title=$row['title'];
        }
        
        return $title;
    }
    
    public static function getFirstRouteID() {
        $route_id = null;

        $sql = "SELECT * " .
                "FROM routes " .              
                "ORDER BY route_id";
        $result = mysql_query($sql) or die(mysql_error());
        
        while ($row = mysql_fetch_array($result)) {
            $route_id=$row['route_id'];
            break;
        }
        
        return $route_id;
    }

}
?>