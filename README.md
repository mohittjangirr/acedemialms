Acedemia Project
Acedemia is a project that serves students with tailored resources, created using HTML, CSS, jQuery, PHP, MySQL, SMTP, and more. This comprehensive web application is designed to enhance the student learning experience by providing personalized academic resources.

Prerequisites
Ensure you have the following software installed on your machine:

XAMPP
Composer (for PHPMailer installation)
Node.js and npm (for OneSignal SDK)
Installation Instructions
XAMPP Installation
For Windows:
Download the XAMPP installer from the official website.
Run the installer and follow the on-screen instructions.
Start the XAMPP control panel and ensure Apache and MySQL services are running.
For Linux:
Open the terminal.

Download XAMPP:

wget https://www.apachefriends.org/xampp-files/7.4.27/xampp-linux-x64-7.4.27-1-installer.run
Make the installer executable:

chmod +x xampp-linux-x64-7.4.27-1-installer.run
Run the installer:

sudo ./xampp-linux-x64-7.4.27-1-installer.run

Follow the on-screen instructions to complete the installation.

sudo /opt/lampp/lampp start

PHPMailer Integration
Open the terminal and navigate to your project directory.

Install Composer if not already installed:


curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
Install PHPMailer via Composer:


composer require phpmailer/phpmailer
In your PHP code, integrate PHPMailer as follows:


// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.example.com';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'your_email@example.com';               // SMTP username
    $mail->Password   = 'your_password';                        // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');           // Add a recipient

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
OneSignal SDK Integration for Push Notifications
Install Node.js and npm if not already installed:

bash
Copy code
sudo apt update
sudo apt install nodejs npm
Install OneSignal SDK:


npm install onesignal-node --save
Integrate OneSignal in your project:


const OneSignal = require('onesignal-node');

// Create a new OneSignal client
const client = new OneSignal.Client({
    userAuthKey: 'YOUR_USER_AUTH_KEY',
    app: { appAuthKey: 'YOUR_APP_AUTH_KEY', appId: 'YOUR_APP_ID' }
});

// Send a notification
const notification = {
    contents: {
        en: 'Your message here'
    },
    included_segments: ['All']
};

client.createNotification(notification)
    .then(response => {
        console.log(response.data);
    })
    .catch(e => {
        console.log('Error:', e);
    });
SMTP Configuration
Configure SMTP settings in your application as per your convenience. Below is an example configuration:


$mail->isSMTP();
$mail->Host = 'smtp.example.com';
$mail->SMTPAuth = true;
$mail->Username = 'your_email@example.com';
$mail->Password = 'your_password';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
Running the Application
Place your project files in the htdocs directory of your XAMPP installation.
Start Apache and MySQL from the XAMPP control panel.
Open your web browser and navigate to http://localhost/your_project_folder.
Contributing
Feel free to fork this repository, submit issues and pull requests. We appreciate your help!
