<?php
require_once dirname(__DIR__).'/swiftmailer5/lib/swift_required.php';
require_once dirname(__DIR__).'/config/config.php';

//Class Mailer
class TMailer{

    private static $instance; 
    private function __construct(){}
    private function __clone(){}
    public static function init(){
        if(!self::$instance){
            
        }
        return self::$instance;          
    }
    public static function sendMail($mailUser,$nickname, $token){       

            try {
                $instance = Swift_SmtpTransport::newInstance(EMAIL_SERVER, EMAIL_PORT, EMAIL_TRANS)
                ->setUsername(EMAIL_USERNAME)
                ->setPassword(EMAIL_PASSWORD);
                $mailer = Swift_Mailer::newInstance($instance);
                $message = Swift_Message::newInstance();
                $message->setSubject('Account Validation');
                $message->setFrom(array('alist.noreply@gmail.com' => 'Alist'));
                $message->setTo($mailUser);
                
                $body = <<<EX
                <html> 
                    <head>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
                    </head>
                    <body>
                        <img src="cid:https://pngimage.net/wp-content/uploads/2018/06/welcome-png-images-4.png" alt="Welcome Gif">
                        <h1>Hi {$nickname}</h1>
                        <p>Welcome to Alist, </br> Please confirm that <b>{$mailUser[0]}</b> is your email adress by clicking on the button below or use this link : <a href="localhost/M306_Alist/verified.php?token={$token}">Verify</a> within 24 hours.</p>                       
                        <a href="localhost/M306_Alist/verified.php?token={$token}" class="form-control btn btn-outline-primary">Account Activation</a>
                    </body>
                </html>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script>
                EX;
                $message->setBody($body,'text/html');
                $result = $mailer->send($message);
            
            } catch (Swift_TransportException $e) {
                echo "Problème d'envoi de message: ".$e->getMessage();
                exit();
            }
        
    }
}

?>