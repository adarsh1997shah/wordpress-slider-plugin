<?php

	// global variable provided by WordPress
	global $wpdb;
	$table_name = $wpdb->prefix . 'custom_slider';

	// condition to check if table name exits in the database or not
if ( $wpdb->get_var( 'SHOW TABLES LIKE "wp_custom_slider"' ) != $table_name ) {

	// query to create table
	$sql_query_to_create_table = '     	
            CREATE TABLE `wp_custom_slider` (
            `image_id` int(11) NOT NULL AUTO_INCREMENT,
            `image_title` varchar(255) DEFAULT NULL,
            `image_img` text,
            `image_pos` int(5) NOT NULL,
            `image_order` int(5) NOT NULL,
            `image_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`image_id`)
           ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1';

	// path that help to include db files
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	// to enter table into database
	dbDelta( $sql_query_to_create_table );
}


