<?php
function save_and_work_listing() {
    $postargs = array(
        'numberposts' => -1,
        'post_type' => 'campaign',
        'order' => 'DESC',
        'post_status' => 'publish'
    );

    $get_campaign = get_posts($postargs);
    $str .= '<div calss="camp_name" style="float:left;width:160px;text-align:center;font-weight: bold;">Campaign Title</div>';
    $str .= '<div class="brand_name" style="float:left;width:160px;text-align:center;font-weight: bold;">Brand Name</div>';
    $str .= '<div class="brand_name" style="float:left;width:160px;text-align:center;font-weight: bold;">Experience</div>';
    $str .= '<div style="float:left;width:160px;text-align:center;font-weight: bold;">Edit & Live</div>';
    $str .= '<div class="live" style="float:left;width:160px;text-align:center;font-weight: bold;">Set Live</div>';
    if (count($get_campaign) > 0):
        foreach ($get_campaign as $campaign):
            $brandname = get_post_meta($campaign->ID, 'camp_brand', true);
            $experience = get_post_meta($campaign->ID, 'camp_exp', true);
            $check_live_or_not = get_post_meta($campaign->ID, '_camp_is_live', true);
            if ($check_live_or_not == '0'):

                $str .= '<div class="edit_save_camp" style="float:left;">';
                $str .= '<div calss="camp_name" style="float:left;width:160px;text-align:center;">' . $campaign->post_title . '</div>';
                $str .= '<div class="brand_name" style="float:left;width:160px;text-align:center;">' . $brandname . '</div>';
                $str .= '<div class="brand_name" style="float:left;width:160px;text-align:center;">' . $experience . '</div>';
                $str .= '<div style="float:left;width:160px;text-align:center;"><a href="' . get_permalink() . '?edit=' . base64_encode($campaign->ID) . '">Edit & Live</a></div>';
                $str .= '<div class="live" style="float:left;width:160px;text-align:center;"><a href="javascript:void(0);" onclick="setlivecamp(\'' . $campaign->ID . '\');"><img style="width:22px;" src="' . CAMPAIGN_PLUGIN_URL . 'images/live.png" title="Set Live" /></a></div>';
                $str .= '<div style="display:none;" id="loader_' . $campaign->ID . '"><img src="' . CAMPAIGN_PLUGIN_URL . 'images/ajax-loader.gif' . '" /></div>';
                $str .= '</div>';
            endif;
        endforeach;
    endif;
    $str .= '<input type="hidden" id="permalink" name="permalink" value="' . get_permalink() . '" />';
    return $str;
}
?>