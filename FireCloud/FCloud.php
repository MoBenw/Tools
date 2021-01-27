<?php
/**
 * Created by PhpStorm.
 * User: mobenw
 * Date: 2019/4/18
 * Time: 15:08
 * Desc: 0则表示数据失败，1则表示成功
 */

class FCloud
{
    public $url = 'http://huoyun888.cn/api/do.php?';
    public $name;   // 账号
    public $password;   // 密码
    private $token; // token令牌
    public $sid;    // 项目id


    /**
     * FCloud constructor.
     * @param $name 账号
     * @param $password  密码
     * @param $sid 项目id
     */
    public function __construct($name, $password, $sid)
    {
        $this->name = $name;
        $this->password = $password;
        $this->token = substr($this->loginIn(), 2);
        $this->sid = $sid;
    }

    /**
     * 爬取数据
     * @param $url
     * @param string $token
     * @return mixed
     */
    public function getData($url)
    {
        $ch = curl_init();
        $timeout = 3;
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,    // 禁止 cURL 验证对等证书
            CURLOPT_CONNECTTIMEOUT => $timeout, // 防止目标服务器的过载
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * 获取登陆token
     * @return bool|string
     */
    public function loginIn()
    {
        $arr = [
            'action' => 'loginIn',
            'name' => $this->name,
            'password' => $this->password
        ];
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        return $data;
    }

    /**
     * 获取一个手机号
     * @param string $locationMatching 包含/不包含
     * @param string $locationLevel 省/市
     * @param string $location 区域
     * @return bool|mixed|string 手机号|地区
     */
    public function getPhone($locationMatching = '', $locationLevel = '', $location = '')
    {
        $arr = [
            'action' => 'getPhone',
            'sid' => $this->sid,
            'token' => $this->token,
        ];

        if (($locationMatching != '') && ($locationLevel != '') && ($location != '')) {
            $arr += [
                'locationMatching' => $locationMatching,
                'locationLevel' => $locationLevel,
                'location' => $location
            ];
        }

        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        sleep(3);
        return $data;
    }

    /**
     * 获取验证码
     * @param $phone 取出来的手机号
     * @return bool|mixed|string
     */
    public function getMessage($phone, $author = '')
    {
        $arr = [
            'action' => 'getMessage',
            'sid' => $this->sid,
            'phone' => $phone,
            'token' => $this->token
        ];
        if ($author != '') {
            $arr += [
                'author' => $author
            ];
        }
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        // 延时3秒
        sleep(3);
        return $data;
    }

    /**
     * 释放指定手机号
     * @param $phone 手机号码
     * @return bool|mixed|string
     */
    public function cancelRecv($phone)
    {
        $arr = [
            'action' => 'cancelRecv',
            'sid' => $this->sid,
            'phone' => $phone,
            'token' => $this->token
        ];
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        return $data;
    }

    /**
     * 手机号加入黑名单
     * @param $phone 手机号码
     * @return bool|mixed|string
     */
    public function addBlacklist($phone)
    {
        $arr = [
            'action' => 'addBlacklist',
            'sid' => $this->sid,
            'phone' => $phone,
            'token' => $this->token
        ];
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        return $data;
    }

    /**
     * 释放当前用户下所有手机号
     * @return bool|mixed|string
     */
    public function cancelAllRecv()
    {
        $arr = [
            'action' => 'cancelAllRecv',
            'token' => $this->token
        ];
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        return $data;
    }

    /**
     * 取当前用户信息
     * @return bool|mixed|string 余额|等级|批量取号数|用户类型
     */
    public function getSummary()
    {
        $arr = [
            'action' => 'getSummary',
            'token' => $this->token
        ];
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        return $data;
    }

    /**
     * 提交发送短信内容
     * @param $phone 取出来的手机号
     * @param $message 要发送的短信内容
     * @param $recvPhone 发送到哪个号码
     * @return bool|mixed|string 提交成功|发送成功的具体内容
     */
    public function putSentMessage($phone, $message, $recvPhone, $author = '')
    {
        $arr = [
            'action' => 'putSentMessage',
            'phone' => $phone,
            'sid' => $this->sid,
            'message' => $message,
            'recvPhone' => $recvPhone,
            'token' => $this->token
        ];
        if ($author != '') {
            $arr += [
                'author' => $author
            ];
        }
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        return $data;
    }

    /**
     * 获取发送短信状态
     * @param $phone 取出来的手机号
     * @return bool|mixed|string
     */
    public function getSentMessageStatus($phone)
    {
        $arr = [
            'action' => 'getSentMessageStatus',
            'phone' => $phone,
            'sid' => $this->sid,
            'token' => $this->token
        ];
        $url = $this->url . http_build_query($arr);

        $data = $this->getData($url);
        return $data;
    }

}
