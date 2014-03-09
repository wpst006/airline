<?php
class dateTimeHelper {

    public static function getDateTimeForUI($stringValue = null) {
        if ($stringValue == null) {
            return date('Y-m-d h:i A');
        } else {
            return date('Y-m-d h:i A', strtotime($stringValue));
        }
    }

}
?>
