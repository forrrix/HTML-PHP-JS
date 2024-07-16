<?php
require 'PHPMailerAutoload.php';


//declaration des variables
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$telNo = $_POST['telNo'];
$email = $_POST['email'];
$adresse = $_POST["adress"];



$uploadOk = 1;

$totalFileSize = array_sum($_FILES['file']['size']);
  if ($totalFileSize > 209715200) {
    $uploadOk = 0;
    echo "taille total des fichiers trop grande";
}

  foreach ($_FILES["file"]["name"] as $index => $file_name) {
  // loop through all file names: file name is available in $file_name and we will grab other file properties directly from $_FILES using $index

  // access other file properties like this:
  $type = $_FILES["file"]["type"][$index];
  $tmp_name = $_FILES["file"]["tmp_name"][$index];
  $error = $_FILES["file"]["error"][$index];
  $size = $_FILES["file"]["size"][$index];

  if (!preg_match_all("/^.*\.(png|pdf|jpeg)$/i",$file_name)) {
    $uploadOk = 0;
    echo "Format d'un fichier incorrect";
  }
  if (strlen($file_name) > 200) {
    $uploadOk = 0;
  }

  $file_name = random_int(100, 999);
}





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

$mail->Subject = 'Demande de Franchise';
$mail->Body    = ' Nom: '.$nom.' Prenom :'.$prenom.' Telephone :'.$telNo.' Adresse: '.$adresse;
$mail->AltBody = 'Nouvelle demande de franchise';

if ($uploadOk == 1) {
for($ct=0;$ct<count($_FILES['file']['tmp_name']);$ct++){
    $mail->AddAttachment($_FILES['file']['tmp_name'][$ct],$_FILES['file']['name'][$ct]);
}
}

echo $uploadOk;

if(!$mail->send()) {
    echo 'Formulaire incorrect';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('Location: index4.html');
}

?>