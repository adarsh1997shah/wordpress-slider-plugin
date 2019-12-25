<?php
    //taking input name in php variable using post method
    $image_id = $_POST['id'];
    $image_pos = $_POST['pos'];
    $img_pos = explode("_",$image_pos);
    

    //name of the table
    $table_name = $wpdb->prefix . "custom_slider";


    //wp function to delete the image when delete button is pressed
    $wpdb->delete(
        $table_name, //table name
        //the unique element to be deleted using image id
        array(
            'image_id' => $image_id
        )
    );

    print_r('Data deleted Successfully');
    // print_r($img_pos);



    //wp function to get the rows from db which have postion greater than the image deleted
    $all = $wpdb->get_results(
        //wpdb prepare for safety like from sql injection
        //takes 2 parameter one query and one string
        $wpdb->prepare(
            "SELECT * from `$table_name` WHERE `$table_name`.`image_pos` > %d",$img_pos[1]
        //by ARRAY_A we convert std objet to array object
        ),ARRAY_A 
    );



    //wp function to update the position values to one less so that position is maintained
    if(count($all)>0){
        foreach($all as $key => $value){
            $wpdb->update(
                $table_name, //table name
                //array of elements to insert into dbms takken from post method
                array(
                    'image_pos' => $value['image_pos'] - 1
                ),
                //the unique element to be updated using image id
                array(
                    'image_id' => $value['image_id']
                )
            );
        }
    }


    // print_r($all);
    //to remove 0 appending at the end of the response
    wp_die();

?>