<?php
class ajaxHelper {

    public static function responseSuccess($data=null) {
        if ($data == null) {
            $data = array();
        }

        $arr = array(
            'success' => true,
            'data' => $data
        );

        return ajaxHelper::responseSend($arr);
    }

    public static function responseFail($data=null) {
        if ($data == null) {
            $data = array();
        }

        $arr = array(
            'success' => false,
            'data' => $data
        );

        return ajaxHelper::responseSend($arr);
    }

    public static function responseSend($data) {
        return json_encode($data);
    }

}

?>
