<?php
$position = $_POST['position'];
// print_r($position);


//name of the table
$table_name = $wpdb->prefix . "custom_slider";


//wp function to get the rows from db which have postion greater than the image deleted
$all = $wpdb->get_results(
    //wpdb prepare for safety like from sql injection
    //takes 2 parameter one query and one string
    $wpdb->prepare(
        "SELECT * from `$table_name`"
    //by ARRAY_A we convert std objet to array object
    ),ARRAY_A 
);

$row = count($all);

//wp function to update the position values to one less so that position is maintained
if(count($all)>0){
    for($i=0;$i<$row;$i++){
        $wpdb->update(
            $table_name, //table name
            //array of elements to change position into dbms taken from post method
            array(
                'image_pos' => $i
            ),
            //the unique element to be updated using image id
            array(
                'image_id' => $all[$i]['image_id']
            )
        );
    }
}


// print_r("Position Switched");
wp_die();
?>