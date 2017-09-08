function cp_user_reg_form()
{
   
    var divID = jQuery('#cp_user_form_msg');
    var err = cp_user_form_validation();
    
    if(err.length != null)
    {
            divID.html('<font color="red">'+err+'</font>');
            divID.fadeIn();
            err = null;
            return false;
    }   
}

function cp_login_form()
{
    var divID = jQuery('#cp_user_login_form_msg');
    var err = cp_user_login_validation();
    
    if(err.length != null)
    {
            divID.html('<font color="red">'+err+'</font>');
            divID.fadeIn();
            err = null;
            return false;
    }    
}

function cp_edit_form()
{
    var divID = jQuery('#cp_user_edit_form_msg');
    var err = cp_user_edit_validation();
    
    if(err.length != null)
    {
            divID.html('<font color="red">'+err+'</font>');
            divID.fadeIn();
            err = null;
            return false;
    }   
}

function donate_form_valid()
{
    var divID = jQuery('#cp_donate_form_msg');
    var err = cp_donate_validation();
    
    if(err.length != null)
    {
            divID.html('<font color="red">'+err+'</font>');
            divID.fadeIn();
            err = null;
            return false;
    }   
}

function cpshowhide(id)
{
    if(id == 'cp_user_profile')
    {
        jQuery('#cp_create_campaign').slideUp();
        jQuery('#cp_manage_camp').slideUp();
        jQuery('#cp_save_work').slideUp();
        jQuery('#cp_home_view').slideUp();
        jQuery('#cp_edit_profile').slideDown();
    }
    else if(id == 'cp_create_camp')
    {
        jQuery('#cp_edit_profile').slideUp();
        jQuery('#cp_manage_camp').slideUp();
        jQuery('#cp_save_work').slideUp();
        jQuery('#cp_home_view').slideUp();
        jQuery('#cp_create_campaign').slideDown();
    }else if(id == "cp_camp_view" ){
        jQuery('#cp_edit_profile').slideUp();
        jQuery('#cp_create_campaign').slideUp();
        jQuery('#cp_save_work').slideUp();
        jQuery('#cp_home_view').slideUp();
        jQuery('#cp_manage_camp').slideDown();
    }else if(id == 'cp_save'){
        jQuery('#cp_edit_profile').slideUp();
        jQuery('#cp_create_campaign').slideUp();
        jQuery('#cp_home_view').slideUp();
        jQuery('#cp_manage_camp').slideUp();
        jQuery('#cp_save_work').slideDown();
    }else{
        jQuery('#cp_edit_profile').slideUp();
        jQuery('#cp_create_campaign').slideUp();
        jQuery('#cp_manage_camp').slideUp();
        jQuery('#cp_save_work').slideUp();
        jQuery('#cp_home_view').slideDown();
    }    
}

function camp_validation()
{
    var divID = jQuery('#cp_camp_form_msg');
    var err = cp_camp_validation();
    
    if(err.length != null)
    {
            divID.html('<font color="red">'+err+'</font>');
            divID.fadeIn();
            err = null;
            return false;
    }
}

function cp_user_form_validation()
{
    
    var user_email = jQuery('#cp_user_email').val();
    var user_pass = jQuery('#cp_user_pass').val();
    var user_brief_info = jQuery('#cp_user_brief_info').val();
    var user_exp = jQuery('#cp_user_exp').val();
    
    var error = null;
    
    if(user_email == '')
    {
        error = 'Plaese Enter Email Address';
    }
    else if(!IsEmail(user_email))
    {
        error = 'Plaese Enter An Valid Email Address' ;
    }
    else if(user_pass == '')
    {
        error = 'Please Give Password';
        
    }
    else if(user_brief_info == '')
    {
        error = 'Please Give Brief Info';
        
    }else if(user_exp == '')
    {
        error = 'Please Give Experince';
    }
    return error;    
    
}

function cp_user_login_validation()
{
    var user_email = jQuery('#user_login_email').val();
    var user_pass = jQuery('#user_login_pass').val();
    var error = null;
    
    if( user_email == '')
    {
        error = 'Please Give Emailid';
    }else if(!IsEmail(user_email))
    {
        error = 'Please Give Valid Email Id';
    }else if(user_pass == '')
    {
        error = 'Please Give Your Password';
    }
    
    return error;
}

function cp_user_edit_validation()
{
    var user_email = jQuery('#cp_user_edit_email').val();
    var error = null;
    
    if(user_email == '')
    {
        error = 'Please Enter Email Address';
    }
    else if(!IsEmail(user_email))
    {
        error = 'Please Enter An Valid Email Address.';
    }
    
    return error;
}

function cp_camp_validation()
{
    var campname = jQuery('#cp_camp_name').val();
    var campinfo = jQuery('#cp_personal_info').val();
    var campbrandname = jQuery('#cp_brand_name').val();
    var campexp = jQuery('#cp_camp_exp').val();
    var campimages = jQuery('#cp_camp_images').val();
    var campvideos = jQuery('#cp_camp_video').val();
    var campduration = jQuery('#camp_duration').val();
    var maxduration = jQuery('#hidden_camp_duration').val();
    var error = null;
    if(campname == '')
    {
        error = 'Please Give Campaign Name.';
    }else if(campinfo == '')
    {
        error = 'Please Give Campaign Personal Info.';
    }else if(campbrandname == '')
    {
        error = 'Please Give Brand Name';
    }    
    else if(campexp == '')
    {
        error = 'Please Give Campaign Experience';
    }else if(campimages == '')
    {
        error = 'Please Upload Campaign Images';
    }else if(campvideos == '')
    {
        error = 'Please Give Embeded Code for video.';
    }else if(campduration == '')
    {
        error = 'Please Give Campaign Duration';
    }else if(campduration > maxduration)
    {
        error = 'Please Give Campaign Duration Within '+maxduration+' Days';
    }    
    
    return error;
}

function cp_donate_validation()
{
    var doner_amt = jQuery('#donate_amount').val();
    var doner_name = jQuery('#funder_name').val();
    var doner_email = jQuery('#funder_email').val();
    var error = null;
    
    if(doner_amt == '')
    {
        error = 'Please Enter Donate Amount';
    }
    else if(doner_name == '')
    {
        error = 'Please Enter Your Name';
    }
    else if(doner_email == '')
    {
        error = 'Please Enter Your Email';
    }
    else if(!IsEmail(doner_email))
    {
        error = 'Please Enter An Valid Email';
    }
    
    return error;
}

function IsEmail(email) {
var regex =  /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;

return regex.test(email);
}

function setlivecamp(id){
    jQuery('#loader_'+id).show();
    var data = {
        action:'set_live',
        id:id
    };
    
    jQuery.post(CampAjax.ajaxurl,data,function(response){
        jQuery('#loader_'+id).hide();
        
        
         window.location.assign(jQuery('#permalink').val());
    })
}