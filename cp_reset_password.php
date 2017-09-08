<?php
function cp_reset_pass() {
    $forgot_email = base64_decode($_GET['cp_forgotpass']);
    $str = '';
    if (isset($_POST['reset_pass_submit'])) {
        $new_password = $_POST['new_cp_pass'];
        $conf_password = $_POST['conf_pass'];

        if ($new_password == '') {
            $msg = 'Please Enter New Password';
        } elseif ($conf_password == '') {
            $msg = 'Please Enter Confirm Password';
        } elseif (strcmp($new_password, $conf_password) != 0) {
            $msg = 'confirm password do not match';
        } else {
            $fetch_user_id = get_user_by('email', $forgot_email);

            $userdata = array('ID' => $fetch_user_id->ID, 'user_pass' => $new_password);
            wp_update_user($userdata);
            update_user_meta($fetch_user_id->ID, 'cp_user_pass', $new_password);

            $msg = 'Password Change Succesfully.Please <a href="' . get_permalink() . '/?cp_login' . '">Login</a>';
        }
        set_transient('cp_forgot_rst_msg', $msg, 30);
        wp_safe_redirect(get_permalink() . '?cp_forgotpass=' . base64_encode($forgot_email));
        exit;
    }
    $str .= get_transient('cp_forgot_rst_msg');
    delete_transient('cp_forgot_msg');



    $str.='    <div class="login_wrap">';
    $str.='    <form name="reset_pass" method="post" action="" >';
    $str.='        <div class="log_field_con">';
    $str.='            <label>Enter New Password:</label>';
    $str.='            <input type="password" name="new_cp_pass" id="new_cp_pass" value="" class="logIn_field" />';
    $str.='        </div>';
    $str.='        <div class="log_field_con">';
    $str.='            <label>Confirm Password:</label>';
    $str.='            <input type="password" name="conf_pass" id="conf_pass" value="" class="logIn_field" />';
    $str.='        </div>';
    $str.='        <div class="log_field_con">';
    $str.='                    <label>&nbsp;</label>';
    $str.='                    <input type="submit" name="reset_pass_submit" value="Submit" class="login_btn" />';
    $str.='            </div>';
    $str.='    </form>';
    $str.='    </div>';
    return $str;
}
?>