<?php
namespace dxkite\user\manager;

use dxkite\support\visitor\Permission;
use dxkite\support\visitor\GrantManager;
use dxkite\user\exception\UserException;
use dxkite\support\file\File;
use dxkite\support\file\Media;

/**
 * 用户管理
 */
class UserManager
{
    const EMAIL_PREG='/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';

    public static function install()
    {
        table('user')->truncate();
        table('grant')->delete(1);
        table('role')->delete(1);
    
        $permissions=(new Permission)->getSystemPermissions();
        $id= (new GrantManager)->createRole('超级管理员', new Permission($permissions));
        $userId=table('user')->add('dxkite', 'dxkite@qq.com', 'dxkite');
        visitor()->signin($userId);
        (new GrantManager)->grant($id, $userId);
        $Tokashi=table('user')->add('Tokashi', '2359964283@qq.com', 'Love990602');
        (new GrantManager)->grant($id, $Tokashi);
    }

    public static function signup(string $name, string $email, string $passowrd)
    {
        return table('user')->add($name, $email, $passowrd);
    }

    public static function getAccountId(string $account)
    {
        if (preg_match(self::EMAIL_PREG, $account)) {
            $id=table('user')->getByEmail($account);
        } else {
            $id=table('user')->getByName($account);
        }
        return $id;
    }

    public static function signin(string $account, string $password, bool $remember=false)
    {
        $id=self::getAccountId($account);
        if ($id) {
            $user=table('user');
            if ($user->getStatus($id) != $user::STATUS_ACTIVE) {
                throw new UserException('account or password error', UserException::ACCOUNT_OR_PASSWORD_ERROR);
            }
            if (table('user')->checkPassword($id, $password)) {
                visitor()->signin($id, 3600, $remember);
                return $id;
            }
        }
        throw new UserException('account or password error', UserException::ACCOUNT_OR_PASSWORD_ERROR);
    }

    public static function signout()
    {
        visitor()->signout();
    }
    
    public static function getAvatarId(int $userId)
    {
        $data=table('user')->select('avatar', ['id'=>$userId])->fetch();
        if ($data) {
            return $data['avatar'];
        }
        return 0;
    }
        
    public static function setAvatar(File $file, int $userId=null)
    {
        $fileInfo=(new Media)->saveFile($file);
        if ($fileInfo) {
            return  table('user')->updateByPrimaryKey($userId??get_user_id(), ['avatar'=>$fileInfo->getId()]);
        }
        return false;
    }
    
    public static function setEmail(string $email)
    {
        return  table('user')->updateByPrimaryKey(get_user_id(), ['email'=>$email]);
    }

    public static function setEmailChecked(int $userId)
    {
        return  table('user')->updateByPrimaryKey($userId, ['validEmail'=>1]);
    }

    public static function setPassword(string $old, string $password)
    {
        $id=get_user_id();
        if (table('user')->checkPassword($id, $old)) {
            return  table('user')->updateByPrimaryKey($id, ['password'=>password_hash($password, PASSWORD_DEFAULT) ]);
        }
        throw new UserException('password error', UserException::ACCOUNT_OR_PASSWORD_ERROR);
    }
    
    public static function editUser(int $userId, string $name, string $email)
    {
        return  table('user')->updateByPrimaryKey($userId, ['name'=>$name,'email'=>$email,'validEmail'=>0 ]);
    }

    public static function editPassword(int $userId, string $password)
    {
        return  table('user')->updateByPrimaryKey($userId, [ 'password'=>password_hash($password, PASSWORD_DEFAULT) ]);
    }
    
    /**
     * 通过ID获取信息
     *
     * @param string $name
     * @return void
     */
    public static function getInfo(int $id)
    {
        return table('user')->setFields(['id','name','email','validEmail','signupTime'])->getByPrimaryKey($id);
    }

    public static function getPublicInfo(int $id)
    {
        $info = table('user')->setFields(['id','name','avatar','signupTime'])->getByPrimaryKey($id);
        if ($info) {
            $info['avatarUrl']= u(module(__FILE__).':avatar', $info['id']);
        }
        return $info;
    }

    public static function getPublicInfoArray(array $id)
    {
        $array = table('user')->select(['id','name','avatar','signupTime'], ['id' => $id])->fetchAll();
        if (!is_array($array)) {
            return null;
        }
        $infoArray = [];
        foreach ($array as $info) {
            $infoArray[$info['id']] = $info;
            $infoArray[$info['id']]['avatarUrl']= u(module(__FILE__).':avatar', $info['id']);
        }
        return $infoArray;
    }
}
