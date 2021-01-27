<?php
namespace dxkite\user\api;

use dxkite\user\manager\UserManger;
use dxkite\user\manager\CodeManager;
use dxkite\user\exception\UserException;
use dxkite\user\manager\InviteManager;

class User
{
    public static function signup(string $name, string $email, string $password, string $code=null)
    {
        if (self::isNeedCode()) {
            if (!CodeManager::check($code)) {
                throw new UserException('human code error', UserException::HUMAN_CODE_ERROR);
            }
        }

        if (self::isNeedInvite()) {
            throw new UserException('need invite code error', UserException::INVITE_CODE_ERROR);
        }
        return UserManager::signup($name, $email, $password);
    }

    public static function signupWithInvite(string $name, string $email, string $password, string $inviteCode, string $code=null)
    {
        if (self::isNeedCode()) {
            if (!CodeManager::check($code)) {
                throw new UserException('human code error', UserException::HUMAN_CODE_ERROR);
            }
        }
        if (self::isNeedInvite()) {
            if (!InviteManager::check($invite)) {
                throw new UserException('invite code error', UserException::INVITE_CODE_ERROR);
            }
        }
        return UserManager::signup($name, $email, $password);
    }

    public static function signin(string $account, string $password, string $code=null)
    {
        if (self::isNeedCode()) {
            if (!CodeManager::check($code)) {
                throw new UserException('human code error', UserException::HUMAN_CODE_ERROR);
            }
        }
        return UserManager::signin($account, $password, $remember);
    }

    public static function info(int $userId=0)
    {
        if ($userId) {
            return UserManager::getPublicInfo($userId);
        }
        return  UserManager::getInfo(get_user_id());
    }

    public static function isNeedCode()
    {
        return setting('user.needCode', true);
    }

    public static function isNeedInvite()
    {
        return setting('user.needInvite', false);
    }
    
    public static function signout()
    {
        UserManger::signout();
    }

    public static function getInviteCode()
    {
        return InviteManager::get();
    }

    public static function createInviteCode()
    {
        return InviteManager::create();
    }
}
