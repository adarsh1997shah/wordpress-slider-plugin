<?php
    //taking input name in php variable using post method
    $image_title = $_POST['image_title'];
    $image_url = $_POST['image_url'];
    $image_upload_time = $_POST['image_upload_time'];
    $image_position = $_POST['image_position'];

    //name of the table
    $table_name = $wpdb->prefix . "custom_slider";

    //using global variable wpdb to insert data into dbms
    //takes 3 parameters
    $wpdb->insert(
        $table_name, //table name
        //array of elements to insert into dbms takken from post method
        array(
            'image_title' => $image_title,
            'image_img' => $image_url,
            'image_time' => $image_upload_time,
            'image_pos' => $image_position
        )
    );

    // print_r($_POST);
    print_r('Data sent Successfully');
    //to remove 0 appending at the end of the response
    wp_die();

?>