<?php
/**
 * Created by PhpStorm.
 * User: mobenw
 * Date: 2019/4/19
 * Time: 01:20
 */


class Life798
{
    public $eid_school = '14926f09043804fa'; // eid号码？ 这个好像是固定值,没错这是固定值
    public $eid_phone;  // 手机的eid
    public $model = 513;    // 不知道这是什么 反正是固定值
    public $pn; // 注册的手机号
    public $pwd;    // 密码test
    public $salt = 'HSMR';  // 一个固定好的盐
    public $crc;    // 某个加密
    public $header = [];     // 头信息 主要是设置Authorization
    public $balance;

    /**
     * Life798 constructor.
     * @param string $pn 手机号
     */
    public function __construct($pn, $pwd = '')
    {
        $this->pn = $pn;
        $this->pwd = $pwd;
        $this->crc = $this->getCrc();
        if ($pwd) {
            $this->login();
            $this->getDevice();
        }
    }


    /**
     * 爬取数据
     * @param $url
     * @param string $token
     * @return mixed
     */
    public function getData($url, $data = '', $type = '')
    {
        $ch = curl_init();
        $timeout = 3;
        if ($data && $type == 'POST') {
            $url .= http_build_query($data);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        }
        if ($data && $type == 'PUT') {
            $url .= http_build_query($data);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        }
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,    // 禁止 cURL 验证对等证书
            CURLOPT_CONNECTTIMEOUT => $timeout,  // 防止目标服务器的过载
            CURLOPT_HTTPHEADER => $this->header   // 添加Authorization  token密匙
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    /**
     * 获取crc密文
     * 其实这个就是加盐MD5
     * @return bool|string
     */
    public function getCrc()
    {
        $pass = $this->pn;
        $salt = $this->salt;
        $pass .= $salt;
        $res = md5($pass);
        return substr($res, 8, 16);
    }


    /**
     * 获取短信验证码 GET
     * $url http://sunxie.hnkzy.com:6767/acc/reg/code?pn=手机号&crc=加密&eid=固定id[14926f09043804fa]&code=图形验证码
     * @param string $code 图形验证码
     * @return mixed
     */
    public function getCode($code)
    {
        $url = 'http://sunxie.hnkzy.com:6767/acc/reg/code?';
        $arr = [
            'pn' => $this->pn,
            'crc' => $this->crc,
            'eid' => $this->eid_school,
            'code' => $code
        ];
        $url .= http_build_query($arr);
        $data = $this->getData($url);
        return json_decode($data, true);
    }


    /**
     * 注册账号 POST
     * $url http://sunxie.hnkzy.com:6767/acc/reg/confirm?pn=手机号&code=短信验证码&pwd=密码&model=似乎是固定的[513]&eid=固定id[14926f09043804fa]
     * @param string $code 短信验证码
     * @param string $pwd 密码
     * @return mixed
     */
    public function register($code, $pwd)
    {
        $this->pwd = $pwd;
        $url = 'http://sunxie.hnkzy.com:6767/acc/reg/confirm?';
        $arr = [
            'pn' => $this->pn,
            'code' => $code,
            'pwd' => $this->pwd,
            'model' => $this->model,
            'eid' => $this->eid_school
        ];
        $data = $this->getData($url, $arr, 'POST');
        return $data;
    }


    /**
     * 登陆账号 POST
     * @return mixed
     */
    public function login()
    {
        $url = 'http://sunxie.hnkzy.com:6767/acc/login?';
        $arr = [
            'pn' => $this->pn,
            'pwd' => $this->pwd,
            'model' => $this->model,
            'eid' => $this->eid_school
        ];
        $data = $this->getData($url, $arr, 'POST');

        // 设置Authorization
        $data_header = json_decode($data, true);
        $this->header[] = 'Authorization: Basic ' . $data_header['data']['did'] . $data_header['data']['security'];

        return $data;

    }


    /**
     * 查看账户相关信息（但不登陆设备有无法得到手机的eid，所以基本上没用） GET
     * @return mixed
     */
    public function getBalance()
    {

        $url = 'http://47.101.162.231:6767/dev/wp/billing/balance?';
        $arr = [
            'eid' => $this->eid_phone
        ];
        $url .= http_build_query($arr);
        $data = $this->getData($url);
        return $data;
    }


    /**
     * 查看设备信息 GET
     * @param string $did 设备号
     * @return mixed
     */
    public function getDevice($did = '8658860302649860')
    {
        $url = 'http://47.101.162.231:6767/kzy/dev/schema?';
        $arr = [
            'hasRate' => 'false',
            'hasAd' => 'true',
            'did' => $did
        ];
        $url .= http_build_query($arr);
        $data = $this->getData($url);

        // 设置余额及手机eid
        $this->balance = json_decode($data, true)['data']['ab']['balance'];
        $this->eid_phone = json_decode($data, true)['data']['ab']['eid'];

        return $data;
    }


    /**
     * 启动饮水设备
     * @param string $did 饮水设备id
     * @return mixed
     */
    public function getStart($did = '865886030264986')
    {
        $did .= '0';
        $url = 'http://47.100.34.165:6767/dev/wp/billing/start?';
        $arr = [
            'did' => $did,
            'eid' => $this->eid_phone,
        ];
        $data = $this->getData($url, $arr, 'PUT');
        return $data;
    }

    /**
     * 关闭饮水设备 PUT
     * @return mixed
     */
    public function getEnd()
    {
        $url = 'http://47.100.34.165:6767/dev/wp/billing/end?';
        $arr = [
            'eid' => $this->eid_phone,
        ];
        $data = $this->getData($url, $arr, 'PUT');
        return $data;
    }

}