<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'srv51.niagahoster.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'infosaguruku@documenthandling.co.id';
        $mail->Password = 'saguruku@14';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('infosaguruku@documenthandling.co.id', 'INFO SAGURUKU'); // Ganti dengan alamat dan nama Anda
        $mail->addReplyTo($email, $name);

        $mail->addAddress('infosaguruku@documenthandling.co.id', 'Info Saguruku');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        
        // Include the name, email, and message in the email body
        $messageBody = "Name: $name<br>Email: $email<br><br>Message: $message";
        $mail->Body = $messageBody;

        $mail->send();
        
        // Display success message and redirect back to contact.php
        echo '<script>alert("Message has been sent"); window.location.href = "contact.php";</script>';
    } catch (Exception $e) {
        echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '"); window.history.back();</script>';
    }
} else {
    echo '<script>alert("Invalid request method."); window.history.back();</script>';
}
?>
