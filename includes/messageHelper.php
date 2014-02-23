<?php

class messageHelper {

    public static function showSuccessMessage($message) {
        return '<div class="alert alert-success">' . $message . '</div>';
    }

    public static function showErrorMessage($message) {
        return '<div class="alert alert-danger">' . $message . '</div>';
    }

    public static function showWarningMessage($message) {
        return '<div class="alert alert-warning">' . $message . '</div>';
    }

    public static function showInfoMessage($message) {
        return '<div class="alert alert-info">' . $message . '</div>';
    }

}

?>
