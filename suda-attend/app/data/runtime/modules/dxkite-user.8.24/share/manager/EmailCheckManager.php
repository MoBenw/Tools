<?php
namespace dxkite\user\manager;

class EmailCheckManager
{
    public static function create(int $user, string $email)
    {
        $code=strtolower(md5(microtime(true).SUDA_VERSION));
        $i=table('emailCheck')->insert([
                'user'=>$user,
                'email'=>$email,
                'time'=>time()+conf('email.time', 3600),
                'token'=>$code
            ]);
        if ($i) {
            return base64_encode(hex2bin($code));
        }
        return false;
    }

    public static function check(string $token)
    {
        $code=strtolower(bin2hex(base64_decode($token)));
        if ($data=table('emailCheck')->select(['id','user'], ' token = :token and time > :time', ['token'=>$code,'time'=>time()])->fetch()) {
            table('emailCheck')->updateByPrimaryKey($data['id'], ['time'=>0]);
            return $data['user'];
        }
        return false;
    }
}
