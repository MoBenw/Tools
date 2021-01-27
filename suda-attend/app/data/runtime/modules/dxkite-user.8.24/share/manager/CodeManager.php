<?php
namespace dxkite\user\manager;

use dxkite\support\visitor\VerifyCode;

class CodeManager
{
    const HUMANCODE='HUMANCODE';
    public static function check(string $code)
    {
        return (new VerifyCode(CodeManager::HUMANCODE))->checkCode($code);
    }

    public static function display()
    {
        return (new VerifyCode(CodeManager::HUMANCODE))->display();
    }

    public static function hasCode()
    {
        return (new VerifyCode(CodeManager::HUMANCODE))->hasCode();
    }
}
