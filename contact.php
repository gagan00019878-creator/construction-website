<?php
$messageStatus = ''; // For showing alert

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'gagan00019878@gmail.com';
        $mail->Password   = 'mgtdqofysjalhzzl';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('gagan00019878@gmail.com', 'SKS Enterprises');
        $mail->addAddress('bhattisaab8987@gmail.com', 'Joe User');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Contact Form Message';
        $mail->Body    = "Name: $name <br>Email: $email <br>Phone: $phone <br>Message: $message";

        // Success popup
        $messageStatus = '<div id="popup" class="alert success">✅ Your message has been sent successfully!</div>';

    } catch (Exception $e) {
        $messageStatus = '<div id="popup" class="alert error">❌ Sorry, something went wrong. Please try again.</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact - SKS Enterprises</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
/* Popup Styling */
.alert {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 18px 25px;
    border-radius: 10px;
    font-size: 16px;
    font-weight: 500;
    z-index: 9999;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    opacity: 1;
    transition: opacity 0.5s ease;
}

/* Success */
.alert.success {
    background: #f3dec4;
    color: #ff8c00;
    border-left: 6px solid #ff8c00;
}

/* Error */
.alert.error {
    background: #fce8e6;
    color: #a71d2a;
    border-left: 6px solid #dc3545;
}

/* Form input styling */
.contact-form input, 
.contact-form textarea {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
}

.contact-form button {
    padding: 12px 25px;
    background: #ff8c00;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

.contact-form button:hover {
    background: #e57800;
}
</style>
</head>

<body>

<header>
    <div class="logo">SKS Enterprises</div>
    <nav>
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="projects.html">Projects</a>
        <a href="contact.php" class="active">Contact</a>
    </nav>
</header>

<section id="contact" class="contact">
  <div class="container">
    <h2 class="section-title">Contact Us</h2>

    <!-- SHOW MESSAGE POPUP -->
    <?php echo $messageStatus; ?>

    <form class="contact-form" action="" method="post">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="phone" placeholder="Phone (optional)">
        <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
        <button type="submit" name="send">Send Message</button>
    </form>
  </div>
</section>

<!-- AUTO HIDE POPUP JS -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("popup");
    if (popup) {
        setTimeout(() => {
            popup.style.opacity = "0";
            setTimeout(() => {
                popup.style.display = "none";
            }, 500);
        }, 3000);
    }
});
</script>

</body>
</html>
