<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'server-45-136-237-164.da.direct';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'test@acxhosting.xyz';
    $mail->Password   = 'fBALD4cWdfVAYTnRkveC';
    $mail->SMTPSecure = 'ssl'; // หรือ 'tls'
    $mail->Port       = 465;   // หรือ 587 ถ้า TLS

    $mail->setFrom('test@acxhosting.xyz', 'ACX Hosting');
    $mail->addAddress('smellxgenz@gmail.com', 'ลูกค้าทดสอบ');
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->Subject = 'ทดสอบส่งเมลผ่าน DirectAdmin';
    $mail->Body    = '<h3>ทดสอบส่งเมลจาก DirectAdmin SMTP</h3><p>สำเร็จ!</p>';

    $mail->send();
    echo '✅ ส่งอีเมลสำเร็จแล้ว';
} catch (Exception $e) {
    echo "❌ ส่งไม่สำเร็จ: {$mail->ErrorInfo}";
}
?>
