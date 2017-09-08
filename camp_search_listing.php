<?php
function camp_search_listing()
{
    $camp_keyword = $_GET['camp_search'];
    
    global $wpdb,$table_prefix;
    
    $query = 'SELECT * FROM '.$table_prefix.'posts WHERE post_title LIKE "%'.$camp_keyword.'%" AND post_type="campaign"';
    
    $search_result = $wpdb->get_results($query);
    $str = '';
   
    $str.=' <div class="sponsor_wrapper">';
	$str.= '<div class="sm_nav">';
		
		$str.= '<div class="sm_nav_left">Recently Added Campaign</div>';
		$str.= '<div  class="sm_nav_right">';
			$str.= '<div class="sm_search_log">';
				$str.= '<form name="camp_frm" method="get" action="" >';
					$str.= '<input type="text" name="camp_search" value="Enter your keyword" class="search_filed" onclick="if (this.defaultValue==this.value) this.value=\'\'" onblur="if (this.value==\'\') this.value=this.defaultValue" />';
					$str.= '<input type="submit" name="camp_search_submit" value="Go" class="search_btn" />';
				$str.= '</form>';
			$str.= '</div>';
			$str.= '<div class="sm_reg_log"><a href="'. get_permalink().'/?cp_login">Login</a> <a href="'.get_permalink().'/?cp_reg">Register</a></div>';
		$str.= '</div>';
	$str.= '</div>';
    
   $str.= '<div class="campaign_wrapper">';
    
    if(COUNT ($search_result) > 0)
    {
       foreach($search_result as $result)
       {    
           
        $brandname = get_post_meta($result->ID,'camp_brand',true);
        $experience = get_post_meta($result->ID,'camp_exp',true);
        $attachment_id = get_post_meta($result->ID,'_camp_pic',true);
        $image_arr = wp_get_attachment_image_src($attachment_id,'thumbnail');
        $status = get_post_meta($result->ID,'_camp_status',true);
        $first_name = get_user_meta($result->post_author,'first_name',true);
        $last_name  = get_user_meta($result->post_author,'last_name',true);
        
        if($status != 'block')
        {    
     
	$str.=' <div class="single_camp">	 ';
	$str.='	<div class="campaign_title"><a href="'.get_permalink().'?cp_details='.$result->ID.'">'.$result->post_title.'</a></div>';
	$str.='	<div class="campaign_by">By '. $first_name.' '.$last_name.'</div>';
	$str.='	<div class="campaign_brand">Brand Name:'. $brandname.'</div>';
	$str.='	<div class="campaign_experience">Experience:'. $experience.'</div>';
	$str.='	<div class="campaign_img"><img src="'. $image_arr[0].'" /></div>';
	$str.='	<div class="campaign_containt">'.short_content(70,$result->post_content).'</div>';
	$str.='	<div class="campaign_btn"><a class="cap_btn" href="'. get_permalink().'?cp_details='.$result->ID.'">View More</a></div>';
        $str.= '</div>';
	 
        }
        else
        {
            
             $str.='   <div>No Campaign Matched To Your Keyword</div>';
            
        }   
      }
    }
    else
    {
       
           $str.='     <div>No Campaign Matched To Your Keyword</div>';
               
    }

$str.= '</div></div>';

return $str;
}
?>