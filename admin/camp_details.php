<?php
function camp_details_func()
{
    if(isset ($_GET['camp_id']) && $_GET['camp_id']!='')
       camp_view_details();
    else
        camp_listing();
}

function camp_listing()
{
    global $wpdb;
    $campaign_args = array(
        'numberposts' => -1,
        'post_type' => 'campaign',
        'order' => 'DESC',
        'post_status' => 'publish'
    );
    $get_campaign = get_posts($campaign_args);
    
    if(COUNT($get_campaign) >0)
    {
        $i = 0;
        
        foreach($get_campaign as $camp)
        {
            $exp = get_post_meta($camp->ID,'camp_exp',true);
            $get_userdata = get_userdata($camp->post_author);
            $get_status = get_post_meta($camp->ID,'_camp_status',true);
            if($get_status == 'active')
                $status = 'Active';
            else
                $status = 'Block';
            
            $camp_arr = array('ID'=>$camp->ID,'campname'=>$camp->post_title,'campowner'=>$get_userdata->user_email,'exp'=>$exp,'status'=>$status);
            $camp_listing[$i] = $camp_arr;
            $i++;
        }
    }
    
    $camp_list_class = new Campaign_list_table();
    $camp_list_class->prepare_items($camp_listing);
    
    echo $msg = get_transient('camp_action_msg');delete_transient('camp_action_msg');
?>
<div class="wrap">
                <h2>All Campaign Listing</h2>
                <form id="campaigns-filter" method="get">
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                <?php $camp_list_class->display(); ?>
                </form>
            </div>
<?php
}

function camp_view_details()
{
    $campaign_id = $_GET['camp_id'];
    $camp_details = get_post($campaign_id);
    $brandname = get_post_meta($campaign_id,'camp_brand',true);
    $exp = get_post_meta($campaign_id,'camp_exp',true);
    $video = get_post_meta($campaign_id,'camp_video',true);
    $attachment_id = get_post_meta($campaign_id,'_camp_pic',true);
    $image_arr = wp_get_attachment_image_src($attachment_id,'thumbnail');
    
?>
<table class="form-table">
    <tbody>
        <tr>
            <th>Campaign Name</th>
            <td><?= $camp_details->post_title;?></td>
        </tr>
        <tr>
            <th>Experience</th>
            <td><?= $exp;?> year</td>
        </tr>
        <tr>
            <th>Campaign Image</th>
            <td><?= $image_arr[0];?></td>
        </tr>
        <tr>
            <th>Campaign Video</th>
            <td><?= $video;?></td>
        </tr>
        <tr>
            <th>Campaign Info</th>
            <td><?= $camp_details->post_content;?></td>
        </tr>
        <tr>
            <th>Brand Name</th>
            <td><?= $brandname;?></td>
        </tr>
        
    </tbody>
</table>
<?php
    
}
?>