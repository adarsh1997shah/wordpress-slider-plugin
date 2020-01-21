<?php
	/**
	 * Parses and verifies the file doc comment.
	 *
	 * @author    Greg Sherwood <gsherwood@squiz.net>
	 * @copyright 2006-2015 Squiz Pty Ltd (ABN 77 084 670 600)
	 * @license   https://github.com/squizlabs/PHP_CodeSniffer/blob/master/licence.txt BSD Licence
	 * @package   category
	 */

	$image_title       = $_POST['image_title'];
	$image_url         = $_POST['image_url'];
	$image_upload_time = $_POST['image_upload_time'];
	$image_position    = $_POST['image_position'];
	$image_order       = $_POST['image_order'];

	// name of the table.
	$table_name = $wpdb->prefix . 'custom_slider';

	// using global variable wpdb to insert data into dbms.
	// takes 3 parameters.
	$wpdb->insert(
		$table_name, // table name
		// array of elements to insert into dbms takken from post method.
		array(
			'image_title' => $image_title,
			'image_img'   => $image_url,
			'image_time'  => $image_upload_time,
			'image_pos'   => $image_position,
			'image_order' => $image_order,
		)
	);

	echo 'Data sent Successfully';
	// to remove 0 appending at the end of the response.
	wp_die();


