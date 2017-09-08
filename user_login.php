<?php
function user_cp_login() {
    $str = '';
    if (isset($_POST['cp_user_login_submit'])) {
        $cp_user_email = strip_tags(trim($_POST['user_login_email']));
        $cp_user_pass = strip_tags(trim($_POST['user_login_pass']));

        if ($cp_user_email == '') {
            $msg = '<div>Please Give Email Id</div>';
        } elseif ($cp_user_pass == '') {
            $msg = '<div>Please Give Password</div>';
        } else {
            $fetch_user_id = get_user_by('email', $cp_user_email);
            $get_user_data = get_userdata($fetch_user_id->ID);

            $creds = array();
            $creds['user_login'] = $get_user_data->user_login;
            $creds['user_password'] = $cp_user_pass;
            $creds['remember'] = true;
            $user = wp_signon($creds, false);
            if (is_wp_error($user)) {
                set_transient('cp_user_login_msg', 'Email or Password might be wrong', 30);
            } else {
                $location = get_permalink();
                wp_safe_redirect($location);
                exit;
            }
        }
    }



    $str.= ' <div  class="sponsor_wrapper">';
    $str.= '   <div class="sm_nav">';
    $str.= ' <div  class="sm_nav_right">';
    $str.= '  <div class="sm_reg_log">';
    $str.= '<a href="' . get_permalink() . '">Home</a> <a href="' . get_permalink() . '/?cp_login">Login</a> <a href="' . get_permalink() . '/?cp_reg ">Register</a>';
    $str.= '</div>';

    $str.= '</div>';
    $str.= '</div>';
    $str.= '<div class="login_wrapper_holder">';
    $str.= get_transient('cp_user_login_msg');
    delete_transient('cp_user_login_msg');
    $str.= '  <div class="login_wrap">';
    $str.= '<div id="cp_user_login_form_msg" style="display: none;"></div>';
    $str.= '<form name="cp_user_login" method="post" action="" onsubmit="return cp_login_form();">';
    $str.= '	<div class="log_field_con">';
    $str.= '		<label>Enter your Email :</label><input type="text" name="user_login_email" id="user_login_email" value="" class="logIn_field" />';
    $str.='	</div>';
    $str.= '<div class="log_field_con">';
    $str.= '<label>Enter your Password :</label><input type="password" name="user_login_pass" id="user_login_pass" value="" class="logIn_field" />';
    $str.= '</div>';
    $str.= '<div class="log_field_con" style="font-size:11px;"><label>&nbsp;</label><a style="color:#e3564f;" href="' . get_permalink() . '?cp_forgot">Forgot Password</a></div>';
    $str.='<div class="log_field_con" style="width:100%;"><label>&nbsp;</label><input type="submit" name="cp_user_login_submit" value="Login" class="login_btn" /></div>';
    $str.= '</form>';
    $str.= '</div>';
    $str.= '</div>';
    $str.= '<div class="clr"></div>';
    $str.= '</div>';
    return $str;
}

?>