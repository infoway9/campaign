<?php
function cp_user_forgot() {
    $str = '';
    if (isset($_POST['cp_user_forgot_submit'])) {
        $cp_user_forgot_email = $_POST['cp_forgot_email'];

        if ($cp_user_forgot_email == '') {
            $msg = '<div>Please Enter Your Email Address</div>';
        } else {
            $link = get_permalink() . '?cp_forgotpass=' . base64_encode($cp_user_forgot_email);
            $to = $cp_user_forgot_email;
            $message = 'Please <a href="' . $link . '">Click this link </a>to regenerate your passord.';
            send_mail_func($to, 'Forgot Password', $message);
            $msg = '<div>A Password generator link sent to your email.please checked</div>';
            set_transient('forgot_link_msg', $msg, 30);
            $location = get_permalink() . '/?cp_forgot';
            wp_safe_redirect($location);
            exit;
        }
    }

    $str.= get_transient('forgot_link_msg');
    delete_transient('forgot_link_msg');
    $str.= ' <div  class="sponsor_wrapper">';
    $str.= '   <div class="sm_nav">';
    $str.= ' <div  class="sm_nav_right">';
    $str.= '  <div class="sm_reg_log">';
    $str.= '<a href="' . get_permalink() . '">Home</a> <a href="' . get_permalink() . '/?cp_login">Login</a> <a href="' . get_permalink() . '/?cp_reg ">Register</a>';
    $str.= '</div>';

    $str.= '</div>';
    $str.= '</div>';
    $str.= '<div class="login_wrapper_holder">';
    $str.= '  <div class="login_wrap">';
    $str.='	<form name="cp_forgot" method="post" action="">';
    $str.='		<div class="log_field_con">';
    $str.='			<label>Enter Your Email Id:</label>';
    $str.='			<input type="text" name="cp_forgot_email" id="cp_forgot_email" value="" class="logIn_field" />';
    $str.='		</div>';
    $str.='		<div class="log_field_con">';
    $str.='			<label>&nbsp;</label>';
    $str.='			<input type="submit" name="cp_user_forgot_submit" value="Submit" class="regi_btn" /></div>';
    $str.= '</form>';
    $str.='	</div>';
    $str.= '</div>';
    $str.= '</div>';

    return $str;
}
?>