
<?php

    function validate($msg, $type = 'danger'){

        return '<p class="alert alert-'.$type.'"> '.$msg.' ! <button class="close" data-dismiss ="alert">&times;</button></p>';

    }


    /**
     * Database control
     */

     function insert($sql){

        global $connection;
        $connection -> query($sql);
     }


    /**
     * Database control
     */

     function valueCheck($table, $column, $val){

        global $connection;

        $sql = " SELECT $column FROM $table WHERE $column='$val'";
        $data = $connection -> query($sql);
        return $data -> num_rows;

     }


