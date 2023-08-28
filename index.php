<?php
session_start;
if(isset($_POST['send'])){
    //extraction des variables
    extract($_POST);
    //vérifions si les variables existent et ne sont pas vides
    if(isset($username) && $username != "" &&
        isset($email) && $email != "" &&
        isset($phone) && $phone != "" &&
        isset($message) && $message != ""){

            //envoyé l'e-mail
            //le destinataire (votre adresse mail)
        
            $to = "dominiquemalik20@gmail.com";
            //objet du mail
            $subject = "vous avez reçu un message de: ". $email;

            $message = "
                <p>Vous avez reçu un message de <strong>". $email ."</strong></p>
                <p><strong>Nom:</strong>". $username ."</p>
                <p><strong>Téléphone: </strong>". $phone ."</p>
                <p><strong>Message: </strong>". $message ."</p>
            ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <'. $email .'>' . "\r\n";

            //envoie du mail
            $send= mail($to,$subject,$message,$headers);
            //vérification de l'envoi
            if($send){
                $_SESSION['succes_message'] = "message envoyé";
            }else{
                $info = "message non envoyé";
            }




    }else{
        //si elles sont vides
        $info = "veuillez remplir tous les champs !";
    }
}   


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send an email with a form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        //afficher le message d'érreur
        if(isset($info)){ ?>
            <p class="request_message" style= "color: red">
                <?php echo $info; ?>
            </p>
        <?php
        }
    ?>

    <?php
        //afficher le message de succes
        if(isset($_SESSION['succes_message'])){ ?>
            <p class="request_message" style= "color: green">
                <?php echo  $_SESSION['succes_message']; ?>
            </p>
        <?php
        }
    ?>
    
    <form action="" method="post">
        <label>Username</label>
        <input type="text" name="username">
        <label>Email</label>
        <input type="text" name="email">
        <label>Phone</label>
        <input type="number" name="phone">
        <label>Message</label>
        <textarea name="message" cols="30" rows="10"></textarea>
        <button name="send">send</button>
    </form>
</body>
</html>