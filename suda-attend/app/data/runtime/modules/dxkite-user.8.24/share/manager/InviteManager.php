<?php
namespace dxkite\user\manager;

class InviteManager
{
    public static function create()
    {
        $code=strtolower(md5(microtime(true).SUDA_VERSION));
        $userId=get_user_id();
        if ($id=table('invite')->select('id', ['user'=>$userId])->fetch()) {
            $i=table('invite')->updateByPrimaryKey($id['id'], [
                'inviteCode'=>$code
            ]);
        } else {
            $i=table('invite')->insert([
                'inviteCode'=>$code,
                'user'=>$userId,
            ]);
        }
        if ($i) {
            return base64_encode(hex2bin($code));
        }
        return false;
    }

    public static function get()
    {
        $userId=get_user_id();
        if ($id=table('invite')->select(['id','inviteCode'], ['user'=>$userId])->fetch()) {
            return base64_encode(hex2bin($id['inviteCode']));
        } else {
            $code=strtolower(md5(microtime(true).SUDA_VERSION));
            if (table('invite')->insert([
                'inviteCode'=>$code,
                'user'=>$userId,
            ])) {
                return base64_encode(hex2bin($code));
            }
        }
        return false;
    }

    public static function check(string $inviteCode)
    {
        $code=strtolower(bin2hex(base64_decode($inviteCode)));
        return table('invite')->select('id', ['inviteCode'=>$code])->fetch()?true:false;
    }

    public static function bind(int $userId, string $inviteCode)
    {
        $code=strtolower(bin2hex(base64_decode($inviteCode)));
        if ($id=table('invite')->select('id', ['user'=>$userId])->fetch()) {
            return table('invite')->updateByPrimaryKey($id['id'], [
                'invitedCode'=>$code
            ]);
        }else{
            $inviteCode=strtolower(md5(microtime(true).SUDA_VERSION));
            return table('invite')->insert([
                'inviteCode'=>$inviteCode,
                'invitedCode'=>$code,
                'user'=>$userId,
            ]);
        }
        return false;
    }
}
