<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    $mail = new PHPMailer(true);

    try {
        // SMTP ayarları
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kamilsaglam066@gmail.com';  // kendi gmail adresin
        $mail->Password   = 'qmgc mqhk riwd fqhf';    // Gmail uygulama şifresi
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Alıcı ve gönderici
        $mail->setFrom('kamilsaglam066@gmail.com', 'İletişim Formu');
        $mail->addAddress('kamilsaglam066@gmail.com'); // hedef mail adresi

        // İçerik
        $mail->isHTML(false);
        $mail->Subject = 'Web Sitesi İletişim Formu - Yeni Mesaj';
        $mail->Body    = "Ad Soyad: $name\nE-posta: $email\nTelefon: $phone\n\nMesaj:\n$message";

        $mail->send();
        echo 'Mesajınız başarıyla gönderildi.';
    } catch (Exception $e) {
        echo 'Mesaj gönderilemedi. Hata: ', $mail->ErrorInfo;
    }
}
?>