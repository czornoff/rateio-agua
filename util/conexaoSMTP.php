<?
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '..\vendor\autoload.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->IsHTML(true);
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Port = $_config['smtp']['PORT'];
    
    $mail->Host = $_config['smtp']['HOST'];
    $mail->Username = $_config['smtp']['USER'];
    $mail->Password = $_config['smtp']['PASS'];

    $sender = utf8_decode($_config['app']['NAME']);