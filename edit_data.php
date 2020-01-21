<?php
	// taking input name in php variable using post method
	$image_id          = $_POST['id'];
	$image_title       = $_POST['image_title'];
	$image_url         = $_POST['image_url'];
	$image_upload_time = $_POST['image_upload_time'];

	// name of the table
	$table_name = $wpdb->prefix . 'custom_slider';

	// using global variable wpdb to update data into dbms
	// takes 3 parameters
	$wpdb->update(
		$table_name, // table name
		// array of elements to insert into dbms takken from post method
		array(
			'image_title' => $image_title,
			'image_img'   => $image_url,
			'image_time'  => $image_upload_time,
		),
		// the unique element to be updated using image id
		array(
			'image_id' => $image_id,
		)
	);

	// print_r($image_id);
	print_r( 'Data updated Successfully' );

	// to remove 0 appending at the end of the response
	wp_die();


