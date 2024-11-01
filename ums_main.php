<?php
/*
Plugin Name: wpMetaScribe
Plugin URI: http://metascribe.mikewagman.com
Description: Gets data for user meta - checking a list to see what information is needed
Author: Mike Wagman
Version: 1
Author URI: http://www.questrcreative.com
*/

//add_action('admin_menu', 'my_plugin_menu');
add_shortcode('ums_content', 'ums_content');
add_shortcode('ums_permission', 'ums_permission');
function my_plugin_menu() {
  add_options_page('My Plugin Options', 'My Plugin', 8, __FILE__, 'my_plugin_options');
}

function ums_content($atts,$content)
	{
		$current_user = wp_get_current_user();
		if (usm_HasAccess($current_user->id,$atts)  == 1)
		{
		return $content;	
		}	
		else
		{
		return "";
		}
			
	}

function ums_permission($atts) {
	extract(shortcode_atts(array(),$atts));
	global $wpdb;
	$current_user = wp_get_current_user();
	
	if (usm_HasAccess($current_user->id,$atts)  == 0)
		{
		die("You do not have access to this page");	
		}	
}

function usm_HasAccess($id,$atts)
	{
	global $wpdb;
	$current_user = wp_get_current_user();
	$foundmatch = 0;
	foreach ($atts as $element)
		{
		$splitIt = strrpos($element,":");
		$length = strlen($element);
		$partA = substr($element,0,$splitIt);
		$partB = substr($element,$splitIt,$length-$splitIt);
		if (strlen($partA)==0)
			{
			$partA = $partB;
			$partB= "usm_xxxxx";	
			}	
		$myquery = 	"SELECT * FROM wp_usermeta where user_id = ".$id." and meta_key = '".$partA."'";
		$myrows = $wpdb->get_results( $myquery );
		if (count($myrows) > 0)
			{	
			if ($partB == "usm_xxxxx" )
				{
				$foundmatch=1;
				}
			else
				{
				$partB = substr($partB,1,strlen($partB));
				foreach ($myrows as $myrow)	
					{
					if ($myrow->meta_value == $partB )
						{
							$foundmatch = 1;
						} 	
					}	
				}	
			}
		} 
	$retValue = false;
	if ($foundmatch == 1){$retValue = true;}
	
	return $retValue;	
	}


function mtw_print_r($myArray)
	{
	//echo "<p><pre>";
	//print_r($myArray);
	//echo "</pre>";
	}

/*
function my_plugin_options() {
  echo '<div class="wrap">';
  echo 'Here is where the form would go if I actually had options.
';
  echo '</div>';
}
*/

/*
require('../cms/wp-config.php');  
$wp->init();  
$wp->parse_request();  
$wp->query_posts();  
$wp->register_globals(); 


*/