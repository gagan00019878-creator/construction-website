<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer include
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit'])){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gagan00019878@gmail.com';    // <-- Tumhara Gmail
        $mail->Password = 'your_app_password';       // <-- Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Mail content
        $mail->setFrom('your_email@gmail.com', 'Website Contact');  // From address
        $mail->addAddress('recipient_email@example.com');           // Tumhe jaha mail chahiye

        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Message';
        $mail->Body    = "
            <h3>Contact Request</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong> $message</p>
        ";

        $mail->send();
        echo '<p style="color:green;">Message sent successfully!</p>';
    } catch (Exception $e) {
        echo '<p style="color:red;">Message could not be sent. Mailer Error: '.$mail->ErrorInfo.'</p>';
    }
}
?>
