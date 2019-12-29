<?php
    //taking input name in php variable using post method
    $image_id = $_POST['id'];
    // $image_pos = $_POST['pos'];
    // $img_pos = explode("_",$image_pos);
    // $image_order = $_POST['order'];
    // $img_order = explode("_",$image_order);
    

    //name of the table
    $table_name = $wpdb->prefix . "custom_slider";


     //wp function to get the rows from db which have postion greater than the image deleted
     $image_detail = $wpdb->get_results(
        //wpdb prepare for safety like from sql injection
        //takes 2 parameter one query and one string
        $wpdb->prepare(
            "SELECT image_order,image_pos from `$table_name` WHERE `$table_name`.`image_id` = %d",$image_id
        //by ARRAY_A we convert std objet to array object
        ),ARRAY_A 
    );
    // print_r($image_detail);


    //wp function to delete the image when delete button is pressed
    $wpdb->delete(
        $table_name, //table name
        //the unique element to be deleted using image id
        array(
            'image_id' => $image_id
        )
    );

    // print_r('Data deleted Successfully');
    // print_r($img_pos);



    //wp function to get the rows from db which have postion greater than the image deleted
    $all_pos = $wpdb->get_results(
        //wpdb prepare for safety like from sql injection
        //takes 2 parameter one query and one string
        $wpdb->prepare(
            "SELECT * from `$table_name` WHERE `$table_name`.`image_pos` > %d",$image_detail[0]['image_pos']
        //by ARRAY_A we convert std objet to array object
        ),ARRAY_A 
    );

    $row = count($all_pos);
    // print_r($all_pos);

    //wp function to update the position values to one less so that position is maintained
    if(count($all_pos)>0){
        for($i=0;$i<$row;$i++){
            $wpdb->update(
                $table_name, //table name
                //array of elements to insert into dbms takken from post method
                array(
                    'image_pos' => $all_pos[$i]['image_pos'] - 1
                ),
                //the unique element to be updated using image id
                array(
                    'image_id' => $all_pos[$i]['image_id']
                )
            );
        }
    }


    $all_order = $wpdb->get_results(
        //wpdb prepare for safety like from sql injection
        //takes 2 parameter one query and one string
        $wpdb->prepare(
            "SELECT * from `$table_name` WHERE `$table_name`.`image_order` > %d",$image_detail[0]['image_order']
        //by ARRAY_A we convert std objet to array object
        ),ARRAY_A 
    );

    $row = count($all_order);
    // print_r($all_order);


    if(count($all_order)>0){
        for($i=0;$i<$row;$i++){
            $wpdb->update(
                $table_name, //table name
                //array of elements to insert into dbms takken from post method
                array(
                    'image_order' => $all_order[$i]['image_order'] - 1
                ),
                //the unique element to be updated using image id
                array(
                    'image_id' => $all_order[$i]['image_id']
                )
            );
        }
    }


    // print_r($all);
    //to remove 0 appending at the end of the response
    wp_die();

?>