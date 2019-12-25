<?php

/**
*Plugin Name: Slider Plugin
*Plugin URI: https://sliderplugin.com/
*Description: Slider Component for Wordpress
*Version: 1.0
*Author: Adarsh Shah
*Author URI: https://adarshshah.com/
*License: GPLv2 or later
*/


//function to see errors

// function tl_save_error() {
//     update_option( 'plugin_error',  ob_get_contents() );
// }
// add_action( 'activated_plugin', 'tl_save_error' );
// /* Then to display the error message: */
// echo get_option( 'plugin_error' );
// /* Or you could do the following: */
// file_put_contents( 'C:\errors' , ob_get_contents() ); // or any suspected variable







//function to create table
function custom_slider_table_active(){

    include_once PLUGIN_DIR_PATH . "/views/create_table.php";
}

register_activation_hook(__FILE__,"custom_slider_table_active");



//function to delete the table
function custom_slider_table_deactivate(){
    global $wpdb;

    $wpdb->query("DROP table IF Exists wp_custom_slider");
}

register_deactivation_hook(__FILE__,"custom_slider_table_deactivate");






//Defining path as a global variable
//defines current file path
define("PLUGIN_DIR_PATH",plugin_dir_path( __FILE__ ));
//defines the current file url
define("PLUGIN_URL",plugin_dir_url( __FILE__ ));
define("PLUGIN_VERSION","1.0");

//function to add menu page and sub menus
function custom_slider(){
    add_menu_page( 
        "customslider",   //page title
        "Custom Slider",  //menu tilte
        "manage_options", //capability
        "main-page",  //page slug
        "custom_slider_view_mainpage", //callback function
        "", //dash-icon for icon
        11 //position where to place in admin menu
        );

    add_submenu_page( 
        "main-page",  //parent slug
        "mainoage",  //menu title
        "Main Page",  //page tiltle
        "manage_options",  //capability
        "main-page", //sub menu slug
        "custom_slider_view_mainpage" //callback funtion
    );
}
add_action( "admin_menu","custom_slider");

function custom_slider_view_mainpage(){
    include_once PLUGIN_DIR_PATH . "/views/main.php";
}


//adding external css and js files
function adding_files(){
    wp_enqueue_style( 
        "cpl_style",  //unique name
        plugins_url('views/css/style.css', __FILE__) //for url to style file
        //"" //dependency attribute
        //PLUGIN_VERSION, //plugin version number
        //false //for adding css file either in header or in footer
    );

    wp_enqueue_script( "jquery");

    wp_enqueue_script( 
        "cpl_script",  //unique name
        PLUGIN_URL."views/js/script.js", //for url to script file
        //"", //dependency attribute
        //PLUGIN_VERSION, //plugin version number
        true //for adding css file either in header or in footer
    );

    

    wp_enqueue_script( 
        "cpl_script_jquery-ui",  //unique name
        PLUGIN_URL."views/js/jquery-ui.js", //for url to script file
        //"", //dependency attribute
        //"", //plugin version number
        true //for adding css file either in header or in footer
    );

    wp_enqueue_script( 
        "cpl_script_jquery_slider",  //unique name
        PLUGIN_URL."views/js/sliderjquery.js", //for url to script file
        //"", //dependency attribute
        //"", //plugin version number
        true //for adding css file either in header or in footer
    );

    wp_enqueue_script( 
        "cpl_script_responsive_slide_min",  //unique name
        PLUGIN_URL."views/js/responsiveslides.min.js", //for url to script file
        //"", //dependency attribute
        //"", //plugin version number
        true //for adding css file either in header or in footer
    );

    wp_enqueue_script( 
        "cpl_script_responsive_slide",  //unique name
        PLUGIN_URL."views/js/responsiveslides.js", //for url to script file
        //"", //dependency attribute
        //"", //plugin version number
        true //for adding css file either in header or in footer
    );

    wp_localize_script(
        'cpl_script',  //name of the js file where ajax call takes place
        'the_ajax_send', //name of the ajax object
         array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) //url of the ajax object that is passed to the post function
    );

    wp_localize_script(
        'cpl_script',  //name of the js file where ajax call takes place
        'the_ajax_update', //name of the ajax object
         array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) //url of the ajax object that is passed to the post function
    );

    wp_localize_script(
        'cpl_script',  //name of the js file where ajax call takes place
        'the_ajax_delete', //name of the ajax object
         array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) //url of the ajax object that is passed to the post function
    );

    wp_localize_script(
        'cpl_script',  //name of the js file where ajax call takes place
        'the_ajax_position', //name of the ajax object
         array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) //url of the ajax object that is passed to the post function
    );
}

add_action( "init", "adding_files");


//handling the request of the ajax like inserting data of the form to the database
function ajax_request_send(){
    global $wpdb;
    include_once PLUGIN_DIR_PATH . "/send_data.php";
}

//first parameter is the wp_ajax_action_name that is passed in the data variable in script
add_action("wp_ajax_send_response","ajax_request_send");


function ajax_request_update(){
    global $wpdb;
    include_once PLUGIN_DIR_PATH . "/edit_data.php";
}

//first parameter is the wp_ajax_action_name that is passed in the data variable in script
add_action("wp_ajax_update_response","ajax_request_update");


function ajax_request_delete(){
    global $wpdb;
    include_once PLUGIN_DIR_PATH . "/delete_data.php";
}

//first parameter is the wp_ajax_action_name that is passed in the data variable in script
add_action("wp_ajax_delete_response","ajax_request_delete");


function ajax_request_position(){
    global $wpdb;
    include_once PLUGIN_DIR_PATH . "/position_data.php";
}

//first parameter is the wp_ajax_action_name that is passed in the data variable in script
add_action("wp_ajax_position_response","ajax_request_position");



//function to add shortcode
function custom_slider_shortcode(){
    include_once PLUGIN_DIR_PATH . "/get_data.php";

    if(count($all_images)>0){
        //using variable html to avoid any error
        $html = '<ul class="rslides">';
        for($i=0;$i<$row_count;$i++){
            foreach($all_images as $key => $value){
                if($value['image_pos'] == $i){
                    $html .= '<li><img id="'.$value['image_id'].'" src="'.$value['image_img'].'" alt=""></li>';
                }
            }
        }
        $html .= '</ul>';
    }

    //returning variable to display the slide
    return $html;
}

//action hook of shortcode
//takes two parameter 1. name if the shortcode , 2.function name
add_shortcode("slider-shortcode","custom_slider_shortcode");