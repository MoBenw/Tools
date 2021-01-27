<?php
/**
 * Created by PhpStorm.
 * User: mobenw
 * Date: 2019/3/16
 * Time: 18:18
 */


// 开启session
session_start();
// 由于教务网的编码为gbk
header("Content-type: text/html; charset=gbk");


/**
 * 模拟登入
 * @param $url
 * @param $cookie
 * @param $post
 * @return bool|string
 */
function login_post($url, $cookie, $post = '', $referer = 'http://113.246.56.102/')
{
    $ch = curl_init(); // 初始化
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,  // url
        CURLOPT_HEADER => 1,  // head 这里设置成1 为了查看当时的cookie
        CURLOPT_RETURNTRANSFER => 1,  // 避免自动输出
        CURLOPT_FOLLOWLOCATION => 1,  // 跟踪重定向页面
//        CURLOPT_COOKIEFILE=>$cookie,    // 设置cookie
        CURLOPT_COOKIE => $cookie,    // 设置cookie
        CURLOPT_REFERER => $referer,  //referer
        CURLOPT_POSTFIELDS => $post   //数据

    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// 获取学号、密码、验证码、cookie
$_SESSION['xh'] = $_POST['xh'];
$xh = $_POST['xh'];
$pw = $_POST['pw'];
$code = $_POST['code'];
//$cookie = dirname(__FILE__) . '/cookie/' . $_SESSION['id'] . '.txt'; // 当使用*FILE时
$cookie = $_SESSION['cookie'];

// 测试输出cookie
echo 'cookie=' . $cookie . '<br>';

// 登入的url 也就是重定向的那个
$url = "http://113.246.56.102/default2.aspx";

/*
 * 首次登入时为了获取__VIEWSTATE
 * 这里一般情况为一个定制，这里只是为了万一
 */
$login1 = login_post($url, $cookie, '');
preg_match_all('/<input type="hidden" name="__VIEWSTATE" value="([^<>]+)" \/>/', $login1, $view); //获取__VIEWSTATE字段并存到$view数组中

// 将数据写入$post
$post = array(
    '__VIEWSTATE' => $view[1][0],
    'txtUserName' => $xh,
    'TextBox2' => $pw,
    'txtSecretCode' => $code,
    'RadioButtonList1' => '%D1%A7%C9%FA', // 学生的gbk编码
    'Button1' => '',
    'lbLanguage' => '',
    'hidPdrs' => '',
    'hidsc' => ''
);

// 正式登入
$login2 = login_post($url, $cookie, http_build_query($post));

// html形式查看
// echo $login1;
//echo $login2;


// 获取课表
$kb_url = "113.246.56.102/xskbcx.aspx?xh=" . $_SESSION['xh'];
$kb = login_post($kb_url, $cookie);
//echo $kb;


// 获取姓名
preg_match_all('/<span id="xhxm">([^<>]+)/', $login2, $xm);
$xm = substr($xm[1][0], 0, -4);

echo $xm;


// 获取__VIEWSTATE
$cj_url = 'http://113.246.56.102/xscj_gc.aspx?xh=' . $_SESSION['xh'] . '&xm=' . $xm;//.'&gnmkdm=N121605';
$viewstate = login_post($cj_url, $cookie);
preg_match_all('/<input type="hidden" name="__VIEWSTATE" value="([^<>]+)" \/>/', $viewstate, $view2);
$state = $view2[1][0];

echo $state;

// 制作数据
$cj_post = array(
    '__VIEWSTATE' => $state,
    'ddlXN' => '2017-2018',  //当前学年
    'ddlXQ' => '1',  //当前学期
    'Button5' => '%B0%B4%D1%A7%C4%EA%B2%E9%D1%AF'  //“学年查询”的gbk编码，视情况而定
);

// TODO:模拟查询
$cj = login_post($cj_url, $cookie, http_build_query($cj_post));
echo $cj;
