<!-- <?php
// send-mail.php
header('Content-Type: application/json; charset=utf-8');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status'=>'error','message'=>'Method not allowed']);
    exit;
}

// Helper: prevent header injection
function clean_header($str){
    return preg_replace("/[\r\n]|(%0A)|(%0D)/i",'', $str);
}

// Read & sanitize inputs
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Basic validation
$errors = [];
if (strlen($name) < 2) $errors[] = 'Please enter your name.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email.';
if (strlen($message) < 10) $errors[] = 'Please enter a longer message.';

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['status'=>'error','message'=>implode(' ', $errors)]);
    exit;
}

// Protect headers
$from_name = clean_header($name);
$from_email = clean_header($email);

// Recipient — <<-- CHANGE THIS to the client email BEFORE DEPLOY -->> 
$to = "yourclient@example.com"; 

$subject = "New contact from website — SKS Enterprises";
$body = "You have a new message from your website contact form.\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n";
if ($phone !== '') $body .= "Phone: {$phone}\n";
$body .= "Message:\n{$message}\n\n";
$body .= "IP: " . ($_SERVER['REMOTE_ADDR'] ?? 'unknown') . "\n";
$body .= "Time: " . date('Y-m-d H:i:s') . "\n";

// Additional headers
$headers = "From: {$from_name} <{$from_email}>\r\n";
$headers .= "Reply-To: {$from_email}\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8\r\n";

// Try PHP mail()
$sent = @mail($to, $subject, $body, $headers);

if ($sent) {
    echo json_encode(['status'=>'success','message'=>'Thanks — your message has been sent.']);
    exit;
}

// If mail() fails, return error (optionally fallback to SMTP below)
http_response_code(500);
echo json_encode(['status'=>'error','message'=>'Sorry — could not send the message. Please try again later.']);
exit; -->

/*
========= Optional: PHPMailer SMTP fallback =========
If your host disables PHP mail(), uncomment and configure PHPMailer and SMTP settings.
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.yourprovider.com';
$mail->SMTPAuth = true;
$mail->Username = 'smtp-user';
$mail->Password = 'smtp-pass';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom($from_email, $from_name);
$mail->addAddress($to);
$mail->Subject = $subject;
$mail->Body = $body;
if($mail->send()){
    echo json_encode(['status'=>'success','message'=>'Thanks — your message has been sent.']);
} else {
    http_response_code(500);
    echo json_encode(['status'=>'error','message'=>'Mailer Error: '.$mail->ErrorInfo]);
}
*/
?>
