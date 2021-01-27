<?php
/**
 * Created by PhpStorm.
 * User: mobenw
 * Date: 2019/3/16
 * Time: 18:16
 */


session_start();


//  验证码地址
$verify_code_url = "http://113.246.56.102/CheckCode.aspx";
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $verify_code_url);
curl_setopt($curl, CURLOPT_HEADER, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

// 解析http数据流
list($header, $body) = explode("\r\n\r\n", $result);

// 将验证码写入到本地文件中
$fp = fopen("verifyCode.jpg", "w");
fwrite($fp, $body);
fclose($fp);

// 解析cookie
preg_match("/set\-cookie:([^\r\n]*);/i", $header, $matches);
$cookie = $matches[1];

$_SESSION['cookie'] = $cookie;

// 测试输出cookie
echo 'cookie='.$cookie.'<br>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>表单提交</title>
</head>
<body>
    <form action="core.php" method="post">
        <table>
            <tr>
                <th>学号</th>
                <th><input type="text" name='xh'></th>
            </tr>
            <tr>
                <th>密码</th>
                <th><input type="text" name='pw'></th>
            </tr>
            <tr>
                <th>验证码</th>
                <th><input type="text" name='code'></th>
            </tr>
            <tr>
                <th><input type="submit" value="提交"></th>
            </tr>
        </table>
    </form>
</body>
</html>