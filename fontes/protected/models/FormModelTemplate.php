<?php

/**
 * FormModelTemplate class
 * This class is SQL commands for FormModelTemplate page
 * 
 */
class FormModelTemplate extends CFormModel {

    public function datePTtoEN($date) {
        $dt = explode('/', $date);
        return $dt[2] . '-' . $dt[1] . '-' . $dt[0];
    }

    public static function arrayToList($array) {
        $lst = "'" . implode("','", $array) . "'";
        return $lst;
    }

}
