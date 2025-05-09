<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone   = htmlspecialchars(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    $to = "kamilsaglam066@gmail.com"; // Buraya kendi e-posta adresini yaz
    $subject = "Web Sitesi İletişim Formu - Yeni Mesaj";

    $email_content = "Ad Soyad: $name\n";
    $email_content .= "E-posta: $email\n";
    $email_content .= "Telefon: $phone\n\n";
    $email_content .= "Mesaj:\n$message\n";

    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $email_content, $headers)) {
        echo "<p>Mesajınız başarıyla gönderildi. Teşekkür ederiz!</p>";
    } else {
        echo "<p>Mesaj gönderilirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.</p>";
    }

} else {
    http_response_code(403);
    echo "<p>Bu sayfaya doğrudan erişim reddedildi.</p>";
}
?>
