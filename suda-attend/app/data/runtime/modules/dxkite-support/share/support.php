<?php

function proxy(string $tableName, bool $outputFile=false)
{
    return dxkite\support\proxy\ProxyInstance::getInstance($tableName, $outputFile);
}


function invoke($class)
{
    if (is_string($class)) {
        $class=new $class;
    }
    return new dxkite\support\proxy\Proxy($class);
}

function context()
{
    return dxkite\support\visitor\Context::getInstance();
}

function visitor()
{
    return context()->getVisitor();
}

function get_user_id()
{
    return dxkite\support\proxy\ProxyObject::getUserId();
}

function get_user_public_info(int $userId)
{
    $info = conf('support.getUserPublicInfo', null);
    if ($info) {
        return cmd($info)->args($userId);
    }
    return $userId;
}

function get_user_public_info_array(array $userId)
{
    $info = conf('support.getUserPublicInfoAray', null);
    if ($info) {
        return cmd($info)->args($userId);
    }
    return $userId;
}

function has_permission($p)
{
    return dxkite\support\proxy\ProxyObject::hasPermission($p);
}

function setting(string $name, $default=null)
{
    return dxkite\support\setting\Setting::get($name, $default);
}

function setting_set(string $name, $value)
{
    return dxkite\support\setting\Setting::set($name, $value);
}

function support_mailer()
{
    return email_poster(setting('smtp_enable', false)? \suda\mail\Factory::SMTP : \suda\mail\Factory::SENDMAIL);
}
