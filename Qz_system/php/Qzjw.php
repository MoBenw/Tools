<?php
/**
 * Created by PhpStorm.
 * User: mobenw
 * Date: 2019/3/18
 * Time: 21:40
 */


class Qzjw
{
    public $url;
    private $xh;
    private $pwd;
    private $token;

    /**
     * 初始化类并获取token的值
     * Qzjw constructor.
     * @param $url string 链接
     * @param $xh string 学号
     * @param $pwd string 密码
     */
    public function __construct($url, $xh, $pwd)
    {
        $this->url = $url . '?';
        $this->xh = $xh;
        $this->pwd = $pwd;
        $this->token = $this->getToken();
    }

    /**
     * 爬取数据
     * @param string $url 连接
     * @param string $token token
     * @return mixed
     */
    public function getData($url, $token = '')
    {
        $ch = curl_init();
        $timeout = 3;
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,    // 禁止 cURL 验证对等证书
            CURLOPT_CONNECTTIMEOUT => $timeout, // 防止目标服务器的过载
            CURLOPT_HTTPHEADER => [
                'token:' . $token
            ]
        ]);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);  // JSON 格式的字符串进行解码
    }

    /**
     * 获取token--根据用户登录信息获取
     * @return mixed
     */
    public function getToken()
    {
        $data = $this->authUser();
        if ($data['token'] == -1) {
            exit($data['msg']);
        }
        return $data['token'];
    }

    /**
     * 获取用户登入信息
     * @return mixed 返回用户登录信息
     * {flag,username,token,userdwmc,usertype,msg}
     */
    public function authUser()
    {
        $arr = array(
            'method' => 'authUser',
            'xh' => $this->xh,
            'pwd' => $this->pwd
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url);
        return $data;
    }

    /**
     * 获取、周次、周起始解释时间、学年信息
     * ps.一周的开始是星期日
     * @param string $time 【YYYY-MM-DD】 default：【当前时间 format：Y-m-d】
     * @return mixed 返回时间信息
     * [{zc,e_time,s_time,xnxqh}]
     */
    public function getCurrentTime($time = '')
    {
        if ($time === '') {
            $time = date('Y-m-d');
        }
        $arr = array(
            'method' => 'getCurrentTime',
            'currDate' => $time // 查询日期 格式为：Y-m-d
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取课程表
     * @param string $xnxqh 学年学期id【YYYY-YYYY-(1/2)】
     * @param string $zc 周次 【\d】
     * @return mixed 返回课程信息
     * [{jsxm,jsmc,jssj,kssj,kkzc,kcsj,kcmc,sjbz},]
     */
    public function getKbcxAzc($xnxqh, $zc, $xh = null)
    {
        $arr = array(
            'method' => 'getKbcxAzc',
            'xh' => $xh ? $xh : $this->xh,
            'xnxqid' => $xnxqh, //学年 例如：2018-2019-2
            'zc' => $zc //周次 第几周 例如：4
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取成绩信息
     * @param string $xnxqh 学年学期id【YYYY-YYYY-(1/2)】
     * @return mixed 返回成绩信息
     * [{bz,cjbsmc,kclbmc,zcj,xm,xqmc,kcxzmc,kcywmc,ksxzmc,kcmc,xf},]
     */
    public function getCjcx($xnxqh, $xh = null)
    {
        $arr = array(
            'method' => 'getCjcx',
            'xh' => $xh ? $xh : $this->xh,
            'xnxqid' => $xnxqh // 学年学期id 格式：Y-m-d
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取考试信息
     * @return mixed 返回考试信息
     * {}
     */
    public function getKscx($xh = null)
    {
        $arr = array(
            'method' => 'getKscx',
            'xh' => $xh ? $xh : $this->xh,
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }


    /**
     * 获取学号/用户信息（好像没生效）
     * @return mixed 返回用户信息
     * {flag}
     */
    public function getStudentIdInfo($xh = null)
    {
        $arr = array(
            'method' => 'getStudentIdInfo',
            'xh' => $xh ? $xh : $this->xh,
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取帐号信息
     * @return mixed 返回账号信息
     * {fxzy,xh,xm,dqszj,usertype,yxmc,xz,bj,dh,email,rxnf,xb,ksh,nj,qq,zymc}
     */
    public function getUserInfo($xh = null)
    {
        $arr = array(
            'method' => 'getUserInfo',
            'xh' => $xh ? $xh : $this->xh,
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取学年和学期信息
     * @return mixed 返回学年学期信息
     * {isdqxq,xqmc,xnxq01id}
     */
    public function getXnxq($xh = null)
    {
        $arr = array(
            'method' => 'getXnxq',
            'xh' => $xh ? $xh : $this->xh,
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取校区信息
     * @return mixed
     */
    public function getXqcx()
    {
        $arr = array(
            'method' => 'getXqcx'
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取学籍预警信息（这个一般不会有人有吧）
     * @param string $history 【({0:当前预警}/{0:历史预警})】
     * @return mixed 返回学籍预警信息
     * {}
     */
    public function getEarlyWarnInfo($history)
    {
        $arr = array(
            'method' => 'getEarlyWarnInfo',
            'history' => $history // 可取项：[{0:当前预警},{0:历史预警}]
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 获取校区教学楼信息
     * @param string $xqid 校区id 【\d】
     * @return mixed 返回教学楼信息
     * {jzwid,jzwmc}
     */
    public function getJxlcx($xqid)
    {
        $arr = array(
            'method' => 'getJxlcx',
            'xqid' => $xqid // 校区id 格式为：
        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

    /**
     * 查询空教室（有毒每次测试都502）
     * @param string $time 时间 format：Y-m-d
     * @param string $idleTime 时间类型 format：['allday','allday','am','pm','night']
     * @param string $xqid 学区id format：number
     * @param string $jxlid 教学楼id format：number
     * @param string $classroomNumber 教室人数 format：['30','30-40','40-50','60']
     * @return mixed 返回空教室信息
     * [{jxl,jsList[{jsid,jzwid,jsmc,zws,xqmc,jsh,jzwmc,yxzws}]},]
     */
    public function getKxJscx($time, $idleTime, $xqid = '', $jxlid = '', $classroomNumber = '')
    {
        $arr = array(
            'method' => 'getKxJscx',
            'time' => $time,    // 查询日期 格式为：Y-m-d
            'idleTime' => $idleTime, // 具体时间 可取项：['allday','allday','am','pm','night']
            'xqid' => $xqid, // 校区id
            'jxlid' => $jxlid, // 教学楼id
            'classroomNumber' => $classroomNumber // 可容纳人数 可选项：['30','30-40','40-50','60']

        );
        $url = $this->url . http_build_query($arr);
        $data = $this->getData($url, $this->token);
        return $data;
    }

}