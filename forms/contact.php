<?php
/**
 * Requires the "PHP Email Form" library.
 * The "PHP Email Form" library must be uploaded to: assets/vendor/php-email-form/php-email-form.php
 * For more info: https://bootstrapmade.com/php-email-form/
 */

// Replace with your real receiving email address
$receiving_email_address = 'tdwicramasinghe22@gmail.com';

// Path to the PHP Email Form library
$php_email_form_path = __DIR__ . '/../assets/vendor/php-email-form/php-email-form.php';

// Load the library
if (file_exists($php_email_form_path)) {
    include($php_email_form_path);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Check for required POST fields
if (
    !isset($_POST['name']) ||
    !isset($_POST['email']) ||
    !isset($_POST['subject']) ||
    !isset($_POST['message'])
) {
    die('All form fields are required.');
}

// Sanitize input
$name    = strip_tags(trim($_POST['name']));
$email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($_POST['subject']));
$message = strip_tags(trim($_POST['message']));

// Create contact form object
$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $name;
$contact->from_email = $email;
$contact->subject = $subject;

// SMTP configuration (uncomment if using SMTP)
// $contact->smtp = array(
//     'host' => '',
//     'username' => '',
//     'password' => '',
//     'port' => '587'
// );

// Message fields
$contact->add_message($name, 'From');
$contact->add_message($email, 'Email');
$contact->add_message($message, 'Message', 10);

// Send email and output result
echo $contact->send();
?>
