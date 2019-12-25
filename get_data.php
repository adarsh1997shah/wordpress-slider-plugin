<?php
    global $wpdb;

    //prefix of wpdb is wp_
    $table_name = $wpdb->prefix . "custom_slider";

    $all_images = $wpdb->get_results(
        //wpdb prepare for safety like from sql injection
        //takes 2 parameter one query and one string
        $wpdb->prepare(
            'SELECT * from '.$table_name,''
        //by ARRAY_A we convert std objet to array object
        ),ARRAY_A 
    );

    //for counting the number of rows
    $row_count = count($all_images);

    // print_r($row_count);
    // print_r($all_images);
?>