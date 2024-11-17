<?php
$toEmail = '';
$fromEmail = '';
$websiteName = '';

$name = trim($_POST['name']);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone = trim($_POST['phone']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

$headers = "From: $fromEmail\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$emailBody = "Name: $name\n";
$emailBody .= "Email: $email\n";
$emailBody .= "Phone: $phone\n";
$emailBody .= "Subject: $subject\n\n";
$emailBody .= $message;

mail($toEmail, $subject, $emailBody, $headers);

$response = [
    'status' => 'success',
    'message' => 'Message sent successfully.'
];

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    header('Location: thank-you-page.php');
    exit;
}
