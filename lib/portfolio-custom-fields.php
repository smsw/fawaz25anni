<?php
/* ADDS WRITE PANELS TO PORTFOLIO */
add_action('admin_menu', 'create_portfolio_meta_box');
add_action('save_post', 'save_portfolio_data');

$portfolio_meta_boxes=array(

	"project_type"=>array(
		"name"=>"_project_type",
		"std"=>"Image",
		"title"=>"Project Type",
		"title_desc"=>"Choose the type of this project",
		'types' => array('Image', 'Slideshow', 'Video'),
		"description"=>"Choose the type of this project",
		"type" => "select"
	),
	
	"project_video"=>
		array(
		"name"=>"_project_video",
		'context' => 'normal',
		'priority' => 'high',
		"title"=>"Project video",
		"title_desc"=>"",
		"std"=>"",
		"type" => "text-area",
		"description"=>"Paste here your embeded video code. Recommended width of video is 550px. Or set width value to 100%. Don't forget to select the featured image for this video."
	),

);


function create_portfolio_meta_box(){
	if(function_exists('add_meta_box')){
		add_meta_box('new-meta-boxes-4', 'Project settings', 'portfolio_meta_boxes', 'portfolio', 'normal', 'high');
	}
}

function portfolio_meta_boxes(){
	global $post, $portfolio_meta_boxes;
	foreach($portfolio_meta_boxes as $meta_box){
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
		}
	}
}



function save_portfolio_data($post_id){

	global $post, $portfolio_meta_boxes;
	
	foreach($portfolio_meta_boxes as $meta_box){
	
		if(!wp_verify_nonce($_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__))) return $post_id;
		
		if(!current_user_can('edit_post', $post_id)) return $post_id;
    
		$data=$_POST[$meta_box['name'].'_value'];
		
		if(get_post_meta($post_id, $meta_box['name'].'_value')=="") add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
		
		elseif($data !=get_post_meta($post_id, $meta_box['name'].'_value', true)) update_post_meta($post_id, $meta_box['name'].'_value', $data);
		
		elseif($data=="") delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
}
  }