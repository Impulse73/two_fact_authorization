<?php

defined('BOOTSTRAP') or die('Access denied');

function fn_send_code_to_mail ($email) {
    /** @var \Tygh\Mailer\Mailer $mailer */
    $mailer = Tygh::$app['mailer'];
    $auth_code = fn_generate_auth_code();
    $mailer->send(array(
        'to' => $email,
        'from' => 'default_company_orders_department',
        'data' => array(
            'code' => $auth_code,
        ), 'template_code' => 'two_fact_auth_two_fact_auth'), 'A', CART_LANGUAGE);
        return;
}

function fn_generate_auth_code () {
    $value = rand(1001,9999);
    setcookie("auth_code", $value, time()+300);
    return $value;
}

function fn_clear_cookie ($condition) {
    if (isset($condition['auth_code'])) {
        setcookie("auth_code", "", time()-3600);
    }
    if (isset($condition['user_id'])) {
        setcookie("user_id", "", time()-3600);
    }
    if (isset($condition['attempt'])) {
        setcookie("attempt", "", time()-3600);
    }
    if (isset($condition['user_email'])) {
        setcookie("user_id", "", time()-3600);
    }
}