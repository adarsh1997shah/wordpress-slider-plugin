<?php wp_enqueue_media() ?>
<?php include_once PLUGIN_DIR_PATH . "/get_data.php"; ?>



<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Sortable - Default functionality</title>
</head>

<body>
 
<div class="container">

<div class="about">
    <h2>Create Your Own Custom Slider</h2>
</div>

<div class="short_code">
    <h2>Use short-code:<i><b>[slider-shortcode]</b></i></h2>
</div>



<div class="upload_images">
    <input type="button" class="upload_button" value="ADD IMAGES" id="upload_image">
</div>

<div class="form_container">
    <!-- the action value is same as '#' -->
    <form action="javascript:void(0)" method="POST" id="image_detail_form">
        <input type="hidden" name="image_title" id="img_title" value="" placeholder="Image Title">
        <input type="hidden" name="image_url" id="img_url" value="" placeholder="Image Url">
        <input type="hidden" id="image_upload_time" name="img_upload_time" value="" placeholder="Upload Time">
    </form>
</div>


<ul id="image_details_sortable">
<?php
    if(count($all_images)>0){
        
        for($i = 0; $i < $row_count; $i++){
            
?>
    
<?php
    foreach($all_images as $key => $value){
        if($value['image_pos'] == $i){
?>
    <li id="<?php echo "order_".$all_images[$i]['image_order'] ?>">
    <div class="image_container" id="<?php echo "position_".$all_images[$i]['image_pos'] ?>">
        <div class="show_image_box">
            <img class="show_image" id="<?php echo $value['image_id'] ?>"  src="<?php echo $value['image_img']?>">
        </div>
        <div class="show_title">
            <h2 class="title_heading">Image Tile:<i><?php echo $value['image_title'] ?></i></h2>
        </div>
        <div class="button_box">
            <input type="button" class='btn btn_edit' value='EDIT'>
            <input type="button" class='btn btn_delete' value='DELETE'>
        </div>
    </div>
    </li>
<?php
            }
        }
?>
<?php
        }
    }
?>
</ul>

</body>
</html>

