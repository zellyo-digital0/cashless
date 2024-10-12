<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = trim($_POST["name"]);
  $email = trim($_POST["email"]);
  $phone = trim($_POST["phone"]);
  $message = trim($_POST["message"]);
  $accept = trim($_POST["accept"]);

  // validation
  if(empty($name) || empty($email) || empty($phone) || empty($message)) {
    echo "Please fill in all fields.";
    exit;
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit;
  }
  if($accept != "yes") {
    echo "You must accept the terms and conditions.";
    exit;
  }

  // set recipient email address
  $to = "l.briand@cashless.fr";

  // set email subject
  $subject = "New message from $name";

  // set email message
  $message = "Name: $name\nEmail: $email\nPhone: $phone\n\n$message";

  // set email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";

  // send email to recipient
  if(mail($to, $subject, $message, $headers)) {
    echo "Your message has been sent.";
  } else {
    echo "There was an error sending your message. Please try again later.";
  }

  // set autoresponder email subject
  $autoresponder_subject = "Thank you for contacting us";

  // set autoresponder email message
  $autoresponder_message = "Dear $name,\n\nThank you for contacting us. We have received your message and will respond as soon as possible.\n\nBest regards,\nThe Website Team";

  // set autoresponder email headers
  $autoresponder_headers = "From: The Website Team <noreply@example.com>\r\n";
  $autoresponder_headers .= "Reply-To: The Website Team <noreply@example.com>\r\n";

  // send autoresponder email to user
  if(mail($email, $autoresponder_subject, $autoresponder_message, $autoresponder_headers)) {
    // do nothing
  } else {
    echo "There was an error sending the autoresponder email.";
  }
}
?>