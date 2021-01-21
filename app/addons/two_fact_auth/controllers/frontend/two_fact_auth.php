<?php

use Tygh\Development;
use Tygh\Registry;
use Tygh\Helpdesk;
use Tygh\Tools\Url;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if($mode == "check_code") {

        if ($_POST['code'] == $_COOKIE['auth_code']) {
            fn_login_user($_COOKIE['user_id'],true);
        } 
        else {
            return [CONTROLLER_STATUS_REDIRECT, fn_url("two_fact_auth.enter_code?pass=N")];
        }
    }
    return [CONTROLLER_STATUS_REDIRECT, "index.php"];
}

if ($mode == "change_attempt") {
    fn_send_code_to_mail($_COOKIE['user_email']);
    $params = $_REQUEST;

    if (defined('AJAX_REQUEST')) {
        $attempt = $params['attempt'];
        $attempt++;

        setcookie("attempt", $attempt, time()+1000);
        Tygh::$app['view']->assign('attempt_send_code',$attempt);
        Tygh::$app['view']->assign('user_id', $_COOKIE['user_id']);
        Tygh::$app['view']->display('addons/two_fact_auth/views/two_fact_auth/enter_code.tpl');
        exit;

    }
}
if ($mode == "enter_code"){
    if ($_REQUEST['pass'] == 'N') {
        Tygh::$app['view']->assign('pass',$_REQUEST['pass']);
    }
    Tygh::$app['view']->assign('attempt_send_code',$_COOKIE['attempt']);
    Tygh::$app['view']->assign('user_id', $_COOKIE['user_id']);
    
}