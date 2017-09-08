<?php
function fund_details_func()
{
    fund_listing();
}

function fund_listing()
{
    global $wpdb,$table_prefix;
    
    $percentage = get_option('set_percentage');
    
    $query = 'SELECT * FROM '.CAMPAIGN_FUND_TBL;
    if(isset ($_GET['camp_filter']))
    {
        $campaign_id = $_GET['camp_name'];
        
        $query .= ' WHERE campaign_id='.$campaign_id;
    }    
    $results = $wpdb->get_results($query);
    if( COUNT ($results) > 0)
    {
        $j = 0;
        foreach($results as $res )
        {
            $get_campaign = get_post($res->campaign_id);
            $author = $get_campaign->post_author;
            $get_userdata = get_userdata($res->$author);
            $adminamt = $res->doner_amount - ( $res->doner_amount * $percentage/100); 
            $useramt = $res->doner_amount - $adminamt;
            
            $camp_option.= '<option value="'.$res->campaign_id.'">'.$get_campaign->post_title.'<option>';
            $camp_fund_arr = array('campname'=>$get_campaign->post_title,'campowner'=>$get_userdata->user_email,'doneremail'=>$res->doner_email,'donateamount'=>$res->doner_amount,'adminkeepamount'=>$adminamt,'userkeepamount',$useramt);
            $fund_list_arr[$j] = $camp_fund_arr;
            $j++;
            
        }    
    }
    
    $fund_list_class = new Found_list_table();
    $fund_list_class->prepare_items($fund_list_arr);
 ?>
<div class="wrap">
                <h2>All Funding Listing</h2>
                <form id="funds-filter" method="get">
                    <select name="camp_name"><option value="">Select Campaign</option><?= $camp_option;?></select>
                    <input type="submit" name="camp_filter" value="Filter" class="button-secondary" />
                <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
                <?php $fund_list_class->display(); ?>
                </form>
            </div>
<?php   
}
?>