<?php
/* ADDS WRITE PANELS TO PORTFOLIO */
add_action('admin_menu', 'post_meta_boxes');
add_action('save_post', 'save_post_data');

$posts_meta_boxes=array(
	"post_link"=>
		array(
		"name"=>"_post_link",
		'context' => 'normal',
		'priority' => 'high',
		"title"=>"Link URL",
		"title_desc"=>"",
		"std"=>"",
		"description"=>"Enter the link URL (e.g. http://***.com or http://www.***.com)"
	),
	
	"post_quote"=>
		array(
		"name"=>"_post_quote",
		'context' => 'normal',
		'priority' => 'high',
		"title"=>"The Quote",
		"title_desc"=>"",
		"std"=>"",
		"description"=>"Write your quote"
	),
	
	"post_quote_source"=>
		array(
		"name"=>"_post_quote_source",
		'context' => 'normal',
		'priority' => 'high',
		"title"=>"The source",
		"title_desc"=>"",
		"std"=>"",
		"description"=>"Write quote source or leave this field blank. HTML tags are allowed."
	),
	
	"post_video"=>
		array(
		"name"=>"_post_video",
		'context' => 'normal',
		'priority' => 'high',
		"title"=>"The video",
		"title_desc"=>"",
		"std"=>"",
		"description"=>"Paste here your embeded Code. Recommended width of video is 550px"
	),
	
	"post_mp3"=>
		array(
		"name"=>"_post_mp3",
		'context' => 'normal',
		'priority' => 'high',
		"title"=>"MP3 file URL",
		"title_desc"=>"",
		"std"=>"",
		"description"=>"Paste here the URL to the .mp3 audio file."
	),
	
	"post_ogg"=>
		array(
		"name"=>"_post_ogg",
		'context' => 'normal',
		'priority' => 'high',
		"title"=>"OGG file URL",
		"title_desc"=>"",
		"std"=>"",
		"description"=>"Paste here the URL to the .mp3 audio file."
	),
	
	

);


function post_meta_boxes(){
	if(function_exists('add_meta_box')){
		add_meta_box('new-meta-boxes-3', 'Post Settings', 'posts_meta_boxes', 'post', 'normal', 'high');
  }
}


function posts_meta_boxes(){
	global $post, $posts_meta_boxes;
	foreach($posts_meta_boxes as $meta_box){
		$meta_box_value=get_post_meta($post->ID, $meta_box['name'].'_value', true);
		if($meta_box_value=="")$meta_box_value=$meta_box['std'];

		echo'<div class="'.$meta_box['name'].'" style="position:relative;width:100%;padding: 10px 0;"><input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
		echo'<p><label style="color: #333;" for="'.$meta_box['name'].'_value"><strong>'.$meta_box['title'].'</strong>';
		echo'<span style="display:block;margin-top:5px;color:#777777;">'.$meta_box['description'].'</span></label></p>';
		echo'<textarea type="text" name="'.$meta_box['name'].'_value" style="width:100%;height:25px;">'.$meta_box_value.'</textarea></div>';
	}
}


function save_post_data($post_id){
	global $post, $posts_meta_boxes;
	foreach($posts_meta_boxes as $meta_box){
		if(!wp_verify_nonce($_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__))) return $post_id;
		if(!current_user_can('edit_post', $post_id)) return $post_id;
    
		$data=$_POST[$meta_box['name'].'_value'];
		if(get_post_meta($post_id, $meta_box['name'].'_value')=="") add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
		elseif($data !=get_post_meta($post_id, $meta_box['name'].'_value', true)) update_post_meta($post_id, $meta_box['name'].'_value', $data);
		elseif($data=="") delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
	}
 }