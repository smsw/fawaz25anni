<?php
/* ADDS WRITE PANELS WITH BACKGROUNDS */
add_action('admin_menu', 'create_background_meta_box');
add_action('save_post', 'save_background_data');

$background_meta_boxes=array(

	"bg_video"=>array(
		"name"=>"_bg_video",
		"std"=>"",
		"title"=>"Background video for this page",
		"description"=>"Enter an URL to the background video file for this page. Supports: mp4, flv, youtube",
		"type" => "input"
	),

	"bg_audio"=>array(
		"name"=>"_bg_audio",
		"std"=>"",
		"title"=>"Background audio for this page",
		"description"=>"Enter an URL to the audio file. Supports: mp3",
		"type" => "input"
	),

	"bg_image"=>array(
		"name"=>"_bg_image",
		"std"=>"",
		"title"=>"Background image for this page",
		"description"=>"Enter an URL or upload a custom background image for this page. Once uploaded, click 'Use This Image'.",
		"type" => "image"
	),

	"custom_bg_repeat"=>array(
		"name"=>"_custom_bg_repeat",
		"std"=>"no-repeat",
		"title"=>"Custom background repeat",
		'types' => array(
						"repeat",
						"no-repeat",
						"repeat-x",
						"repeat-y"
						),
		"description"=>"",
		"type" => "select"
	),

	"custom_bg_position"=>array(
		"name"=>"_custom_bg_position",
		"std"=>"top left",
		"title"=>"Custom background repeat",
		'types' => array(
						"Top Left",
						"Top Center",
						"Top Right",
						"Center"
						),
		"description"=>"",
		"type" => "select"
	),

	"custom_bg_size"=>array(
		"name"=>"_custom_bg_size",
		"std"=>"original",
		"title"=>"Custom background repeat",
		'types' => array(
						"Full",
						"Original"
						),
		"description"=>"Set original size if you using a pattern for the background",
		"type" => "select"
	),


);


function create_background_meta_box(){
	if(function_exists('add_meta_box')){
		add_meta_box('new-meta-boxes-1', 'Background settings', 'background_meta_boxes', 'portfolio', 'normal', 'high');
		add_meta_box('new-meta-boxes-1', 'Background settings', 'background_meta_boxes', 'page', 'normal', 'high');
		add_meta_box('new-meta-boxes-1', 'Background settings', 'background_meta_boxes', 'post', 'normal', 'high');
	}
}

function background_meta_boxes(){
	global $post, $background_meta_boxes;
	foreach($background_meta_boxes as $meta_box){
		$meta_box_value=get_post_meta($post->ID, $meta_box['name'].'_value', true);
		if($meta_box_value=="")$meta_box_value=$meta_box['std'];

		switch ($meta_box['type']) {

			case 'text-area':

			echo'<div class="'.$meta_box['name'].'" style="position:relative;width:100%;padding: 10px 0;"><input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.	$meta_box['name'].'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
			echo'<p><label style="color: #333;" for="'.$meta_box['name'].'_value"><strong>'.$meta_box['title'].'</strong>';
			echo'<span style="display:block;margin-top:5px;color:#777777;">'.$meta_box['description'].'</span></label></p>';
			echo'<textarea type="text" name="'.$meta_box['name'].'_value" style="width:100%;height:100px;">'.$meta_box_value.'</textarea></div>';

			break;

			case 'select':

			echo'<div class="'.$meta_box['name'].'" style="position:relative;width:100%;padding: 10px 0;"><input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
			echo'<p><label style="color: #333;" for="'.$meta_box['name'].'_value"><strong>'.$meta_box['title'].'</strong>';
			echo'<span style="display:block;margin-top:5px;color:#777777;">'.$meta_box['description'].'</span></label></p>';
			echo '<select name="'.$meta_box['name'].'_value">';

			foreach ($meta_box['types'] as $option) {

						echo'<option value="'.$option.'" id="portfolio-type-'.$option.'"';
						if ($meta_box_value == $option ) {
							echo ' selected="selected"';
						}
						echo'>'. $option .'</option>';

					}

					echo'</select></div>';

			break;

			case 'input':

			echo'<div class="'.$meta_box['name'].'" style="position:relative;width:100%;padding: 10px 0;"><input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.	$meta_box['name'].'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
			echo'<p><label style="color: #333;" for="'.$meta_box['name'].'_value"><strong>'.$meta_box['title'].'</strong>';
			echo'<span style="display:block;margin-top:5px;color:#777777;">'.$meta_box['description'].'</span></label></p>';
			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%"></div>';

			break;

			case 'image':

			echo '<div class="'.$meta_box['name'].'" style="position:relative;width:100%;padding: 10px 0;"><tr valign="top">
				<p><label style="color: #333;" for="'.$meta_box['name'].'_value"><strong>'.$meta_box['title'].'</strong><span style="display:block;margin-top:5px;color:#777777;">'.$meta_box['description'].'</span></label></p>
				<td>
				<label for="'.$meta_box['name'].'_value">
					<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />
					<input style="width:50%;height:25px;" id="upload_image" type="text" size="36" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" />
				</label>
				</td>
			</tr></div>';


           break;
		}
	}
}



function save_background_data($post_id){

	global $post, $background_meta_boxes;

	foreach($background_meta_boxes as $meta_box){

		if(!wp_verify_nonce($_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__))) return $post_id;

		if(!current_user_can('edit_post', $post_id)) return $post_id;

		$data=$_POST[$meta_box['name'].'_value'];

		if(get_post_meta($post_id, $meta_box['name'].'_value')=="") add_post_meta($post_id, $meta_box['name'].'_value', $data, true);

		elseif($data !=get_post_meta($post_id, $meta_box['name'].'_value', true)) update_post_meta($post_id, $meta_box['name'].'_value', $data);

		elseif($data=="") delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
}
  }