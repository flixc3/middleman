<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(isset($_SESSION['Username'])){
    header("location: home");
}
$getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
if (!empty($getLang)) {
$_SESSION['language'] = $getLang;
}
// ========================= config the languages ================================
error_reporting(E_NOTICE ^ E_ALL);
if (is_file('home.php')){
    $path = "";
}elseif (is_file('../home.php')){
    $path =  "../";
}elseif (is_file('../../home.php')){
    $path =  "../../";
}
include_once $path."langs/set_lang.php";
phpinfo() ?>
<html dir="<? echo lang('html_dir'); ?>">
<head>
    <title><? echo lang('welcome'); ?> | MiddleMan</title>
    <meta charset="UTF-8">
    <meta name="description" content="MiddleMan is a platform that standardizes retail supply chains.">
    <meta name="keywords" content="signup,social network,social media,MiddleMan,meet,free platform">
    <meta name="author" content="J&F">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "includes/head_imports_main.php";?>
</head>
    <body class="login_signup_body">
    <!--============[ Nav bar ]============-->
        <div class="login_signup_navbar">
                <a href="index" class="login_signup_navbarLinks">MiddleMan</a>
                <a href="#" class="login_signup_navbarLinks"><? echo lang('help'); ?></a>
                <a href="#" class="login_signup_navbarLinks"><? echo lang('terms'); ?></a>
                <a href="#" class="login_signup_navbarLinks"><? echo lang('privacyPolicy'); ?></a>
                      <div style="float: <? echo lang('float2'); ?>;">
            <a href="login" class="login_signup_btn1"><? echo lang('login'); ?></a>
            <a href="signup" class="login_signup_btn2"><? echo lang('signup'); ?></a>
        </div>
        </div>
        <!--============[ main contains ]============-->
        <div class="login_signup_box">
        <h3 align="center"><? echo lang('welcome_to'); ?> MiddleMan</h3>
        <p align="center" style="color: #999; margin-bottom: 25px;"><? echo lang('middleman_main_string'); ?>.</p>
            <div style="display: flex;">
                <div style="width: 100%;">
                    <br><h4><? echo lang('login_now'); ?></h4>
                    <p><input type="text" name="login_username" id="un" class="login_signup_textfield" placeholder="<? echo lang('email_or_username'); ?>"/></p>
                    <p><input type="password" name="login_password" id="pd" class="login_signup_textfield" placeholder="<? echo lang('password'); ?>"/></p>
                    <p><a href="#" style="color: #a2a2a2; font-size: 11px; float:<? echo lang('float2'); ?>;"> <? echo lang('forgot_password'); ?></a></p>
                    <button type="submit" class="login_signup_btn1" id="loginFunCode"><? echo lang('login'); ?></button>
                    <p id="login_wait" style="margin: 0px;"></p>
                </div>
                <div style="width: 100%;text-align: center;">
                    <img src="imgs/main_icons/pc_main.png" alt="MiddleMan" style="width: 300px;" />
                </div>
            </div>
        </div>
        <div style="background: #fff; border-radius: 3px; max-width: 800px; padding: 15px; margin:auto;margin-top: 15px;color: #7b7b7b;" align="center">
            <? echo lang('dont_have_an_account'); ?> <a href="signup"><? echo lang('signup'); ?></a> <? echo lang('for_free'); ?>.<hr style="margin: 8px;">
                <a href="?lang=english">English</a> &bull; <a href="?lang=العربية">العربية</a>
        </div>

<script type="text/javascript">
function signupUser(){
var fullname = document.getElementById("fn").value;
var username = document.getElementById("un").value;
var emailAdd = document.getElementById("em").value;
var password = document.getElementById("pd").value;
var cpassword = document.getElementById("cpd").value;
var gender = document.getElementById("gr").value;
var role = document.getElementByID("rl").value;
$.ajax({
type:'POST',
url:'includes/login_signup_codes.php',
data:{'req':'signup_code','fn':fullname,'un':username,'em':emailAdd,'pd':password,'cpd':cpassword,'gr':gender, 'rl':role},
beforeSend:function(){
$('.login_signup_btn2').hide();
$('#login_wait').html("<b><? echo lang('creating_your_account'); ?></b>");
},
success:function(data){
$('#login_wait').html(data);
if (data === "Done..") {
    $('#login_wait').html("<p class='alertGreen'><? echo lang('done'); ?>..</p>");
    setTimeout(' window.location.href = "home"; ',2000);
}else{
    $('.login_signup_btn2').show();
}
},
error:function(err){
alert(err);
}
});
}
$('#signupFunCode').click(function(){
signupUser();
});

$(".login_signup_textfield").keypress( function (e) {
    if (e.keyCode == 13) {
        signupUser();
    }
});
</script>
    </body>
</html>
