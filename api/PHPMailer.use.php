<?php
// 引入PHPMailer类
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require("./PHPMailer/src/Exception.php");
require("./PHPMailer/src/PHPMailer.php");
require("./PHPMailer/src/SMTP.php");

// 服务器配置
class emUse{
    var $em;
    function __construct($smtpHost,$smtpAuth,$smtp_username,$smtp_pwd,$smtp_port)
    {
        // 调用类方法时对类变量进行初始化
        $this->em = new PHPMailer(true);
        $uem = $this->em;

        // 配置服务器
        $uem->SMTPDebug = 0;
        $uem->isSMTP();
        $uem->Host = $smtpHost; // 设置发信服务器
        $uem->SMTPAuth = $smtpAuth; // 设置SMTP认证
        $uem->Username = $smtp_username; // 设置发信邮件
        $uem->Password = $smtp_pwd; // 用户密码
        $uem->SMTPSecure = "ssl";
        $uem->Port = $smtp_port; // 设置端口
    }

    function send_mail($from_address,$from_name,$to_address,$sendSub,$sendBody){
        $uem = $this->em;
        $uem->setFrom($from_address,$from_name);
        $uem->addAddress($to_address);
        $uem->isHTML(true);
        $uem->Subject = $sendSub;
        $uem->Body = $sendBody;
        $uem->AltBody = "当前客户端不支持HTML,请尝试其他客户端或者邮箱";
        return $uem->send();
    }
}


?>