<?php
require 'PHPMailerAutoload.php';


//declaration des variables
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$heure = $_POST['heure'];
$date = $_POST['date'];
$telNo = $_POST['telNo'];
$choix = $_POST['choix'];

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'thecoutfitercorner@gmail.com';                 // SMTP username
$mail->Password = 'yanis27nadia';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('thecoutfitercorner@gmail.com');
$mail->addAddress('thecoutfitercorner@gmail.com'); // Name is optional
$mail->addReplyTo('thecoutfitercorner@gmail.com');

$mail->isHTML(true);                                  // Set email format to HTML
//$mail ->SMTPDebug = 3;

$mail->Subject = 'commande';
$mail->Body    = ' Nom: '.$nom.' Prenom :'.$prenom.' Heure :'.$heure.' Date :'.$date.' Telephone :'.$telNo.' Service : '.$choix;
$mail->AltBody = 'Nouvelle commande';




if(!$mail->send()) {
    echo 'Formulaire incorrect';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('Location: index1.html');
}

?>