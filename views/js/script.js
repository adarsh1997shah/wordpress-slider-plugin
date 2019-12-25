//function to implement the position of the image at correct place
jQuery(function() {
    jQuery('#image_details_sortable').sortable({
        axis: 'y',
        update: function(event, ui) {
            var data = jQuery(this).sortable('serialize') + '&action=position_response';
            jQuery.post(the_ajax_position.ajaxurl, data, function(response) {
                alert(response);

                //reloading the page for retrieving data from dbms
                location.reload(true);
            });
        }
    });
    jQuery( "#image_details_sortable" ).disableSelection();
});



//function to insert data into database
jQuery(document).ready(function(){
    //function to include wp_custom media
    jQuery("#upload_image").on("click",function(){
        var image = wp.media({
            title : "Upload image for Slider",
            multiple : false
        }).open().on("select",function(){
            //getting information about the image
            var uploaded_image = image.state().get("selection").first().toJSON();

            //form storing method
            //storing the title of the image
            jQuery("#img_title").val(uploaded_image.title);

            //storing the url of the image
            jQuery("#img_url").val(uploaded_image.url);

            //storing the date when the image was uploaded
            jQuery("#img_upload_time").val(new Date().toISOString().slice(0,19).replace('T',' '));

            //consoling the data sent to the server
            console.log(jQuery("#image_detail_form").serialize());

            var temp;
            //determining the number of li children of the image inserted
            if(jQuery("#image_details_sortable li").length > 0){
                temp = jQuery("#image_details_sortable li").length;
                console.log(temp);
            }
            else{
                temp = 0;
                console.log(temp);
            }

            //variable to send the serialize data to the server
            var send_data = jQuery("#image_detail_form").serialize();

            //the data variable to pass to the function
            var data = send_data + '&action=send_response' + '&image_position=' + temp;

            //jquery post method to send data to the server
            jQuery.post(the_ajax_send.ajaxurl, data, function(response) {
                alert(response);

                //reloading the page for retrieving data from dbms
                location.reload(true);

                //getting form id to reset the form after submitting
                document.getElementById("image_detail_form").reset();
            });
        })
    })
});




//function to update the data of the image into database
function edit(e){
    //function to include wp_custom media
        var image = wp.media({
            title : "Update image for Slider",
            multiple : false
        }).open().on("select",function(){
            //getting information about the image
            var uploaded_image = image.state().get("selection").first().toJSON();

            //form storing method
            //storing the title of the image
            jQuery("#img_title").val(uploaded_image.title);

            //storing the url of the image
            jQuery("#img_url").val(uploaded_image.url);

            //storing the date when the image was uploaded
            jQuery("#img_upload_time").val(new Date().toISOString().slice(0,19).replace('T',' '));

            //consoling the data sent to the server
            // console.log(jQuery("#image_detail_form").serialize());

            //variable to send the serialize data to the server
            var send_data = jQuery("#image_detail_form").serialize();

            //getting id of the current edit button clicked 
            var image_id = jQuery(this).parent().siblings(".show_image_box").children("img").attr('id');

            //the data variable to pass to the function
            var data = send_data + '&id='+ image_id + '&action=update_response';

            console.log(data);
            //jquery post method to send data to the server
            jQuery.post(the_ajax_update.ajaxurl, data, function(response) {
                alert(response);

                //reloading the page for retrieving data from dbms
                location.reload(true);

                //getting form id to reset the form after submitting
                document.getElementById("image_detail_form").reset();
            });
        })
};




//function to delete the image from the database
jQuery(document).ready(function(){
    jQuery(".btn_delete").on("click",function(){
        //getting id of the image
        var image_id = jQuery(this).parent().siblings(".show_image_box").children("img").attr('id');

        //getting image position
        var image_pos = jQuery(this).parent().parent().attr('id');

        //sending image id and position to the database to be deleted
        var data ='&id='+ image_id + '&pos='+ image_pos +'&action=delete_response';

        jQuery.post(the_ajax_delete.ajaxurl, data, function(response) {
            alert(response);

            //reloading the page for retrieving data from dbms
            location.reload(true);
        });
    })
})
