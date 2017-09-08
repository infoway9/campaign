<?php
add_action('admin_menu','cp_menu_func');

function cp_menu_func()
{
    add_menu_page('campaign','Campaign Details',10,'camp-details','camp_details_func');
    add_menu_page('Funding','Funding Details',10,'fund-details','fund_details_func');
    add_submenu_page('fund-details','Paypal','Settings',10,'set-paypal','paypal_func');
}
?>