<?php

use Tygh\Development;
use Tygh\Registry;
use Tygh\Helpdesk;
use Tygh\Tools\Url;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($mode == 'login') {
        if ($_POST['return_url'] != "admin.php") {
            fn_clear_cookie($_COOKIE);
            
            list($status, $user_data, $user_login, $password, $salt) = fn_auth_routines($_REQUEST, $auth);
            if (!empty($user_data) && !empty($password) && fn_generate_salted_password($password, $salt) == $user_data['password']) {
                
                setcookie("user_id", $user_data['user_id'],  time()+1000);
                setcookie("user_email", $user_data['email'], time()+1000);
                fn_send_code_to_mail($user_data['email']);
                if ($_REQUEST['return_url'] == "index.php"){
                    Tygh::$app['ajax']->assign('force_redirection', fn_url("two_fact_auth.enter_code"));
                    exit;
                }  else {
                    fn_redirect(fn_url("two_fact_auth.enter_code"));
                }
            }
        }
    }
}