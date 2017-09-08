<?php
function paypal_func()
{
    paypal_settings();
}

function paypal_settings()
{
    
    if(isset ($_POST['paypal_settings']))
    {
        $paypal_type = $_POST['paypal_type'];
        $live_id = $_POST['live_id'];
        $sandbox_id = $_POST['sandbox_id'];
        $percentage = $_POST['set_percentage'];
        $deadline = $_POST['camp_deadline'];
        
        
        update_option('paypal_type',$paypal_type);
        update_option('live_id',$live_id);
        update_option('sandbox_id',$sandbox_id);
        update_option('set_percentage',$percentage);
        update_option('camp_deadline',$deadline);
        
        $msg = '<div class="updated"><p>Changes Succesfully Saved.</p></div>';
        set_transient('paypal_msg', $msg,30);
        
        $redirect = get_bloginfo('siteurl').'/wp-admin/admin.php?page=set-paypal';
        wp_redirect($redirect);
        exit;
        
    }
    
    $paypal_type = get_option('paypal_type');
    $live_id = get_option('live_id');
    $sandbox_id = get_option('sandbox_id');
    $percentage = get_option('set_percentage');
    $deadline = get_option('camp_deadline');
    
    if($paypal_type == 'live')
    {
        $display = '';
    }
    else
        $display = 'display:none;';
    
    if($paypal_type == 'sandbox')
    {
        $display1 = '';
    }
    else
        $display1 = 'display:none;';
    
    
    if($deadline == '')
        $deadline = 30;
    
   echo $msg = get_transient('paypal_msg');delete_transient('paypal_msg'); 
?>
<script type="text/javascript">
    function showhidediv(type)
    {
        if(type == 'sandbox')
        {
            jQuery('#paypal_live').slideUp();
            jQuery('#paypal_sandbox').slideDown();
        }
        else
         {
             jQuery('#paypal_sandbox').slideUp();
             jQuery('#paypal_live').slideDown();
         }   
            
    }
</script>
<form name="" method="post" action="">
    <h2>Campaign Deadline</h2>
    <div>
        <label>Set Campaign Deadline:</label>
        <input type="text" name="camp_deadline" value="<?= $deadline;?>" /> ( days)
    </div>
    <h2>Paypal Settings</h2>
    <div>
    <input type="radio" name="paypal_type" value="sandbox" onclick="showhidediv(this.value);" <?php if($paypal_type == 'sandbox') echo 'checked=checked;';?> />Sandbox
    <input type="radio" name="paypal_type" value="live" onclick="showhidediv(this.value);" <?php if($paypal_type == 'live') echo 'checked=checked;';?> />Live
    </div>
    <div id="paypal_sandbox" style="<?= $display1;?>">
        <div>
            <label>Sandbox Merchant Id:</label><input type="text" name="sandbox_id" value="<?= $sandbox_id;?>" /> 
        </div>
    </div>
    <div id="paypal_live" style="<?= $display;?>">
        <div>
            <label>Live Merchant Id:</label><input type="text" name="live_id" value="<?= $live_id;?>" /> 
        </div>
    </div>
    <h2>Set Funding Percentage</h2>
    <div>
        <label>Set Percentage:</label><input type="text" name="set_percentage" value="<?= $percentage;?>" /> in ( % )
    </div>
    
    <input type="submit" name="paypal_settings" value="Save" class="button-primary" />
</form>
<?php
}
?>