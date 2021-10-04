<?php


class Sender
{
    public function send($data, $subject, $from, $name)
    {
        $mail = new PHPMailer(PHPMAILER_EXCEPTION);                                            // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = SMTP_DEBUG;                                  // Enable verbose debug output
            switch (MAIL_SENDER_TYPE){
                case 'sendmail':
                    $mail->isSendmail();
                    break;
                case 'smtp':
                    $mail->isSMTP();
                    break;
                case 'mail':
                    $mail->isMail();
                    break;
            }
            $mail->Host = SMTP_HOST;                                        // Specify main and backup SMTP servers
            $mail->SMTPAuth = SMTP_AUTH;                                    // Enable SMTP authentication
            $mail->Username = SMTP_USERNAME;                                // SMTP username
            $mail->Password = SMTP_PASWWORD;                                // SMTP password
            $mail->SMTPSecure = SMTP_SECURE;                                // Enable TLS encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT;                                        // TCP port to connect to

            //Recipients
            $mail->setFrom($from, $name);
            $mail->addAddress(MAIL_FROM_MAIL, MAIL_FROM_NAME);     // Add a recipient
            $mail->addCC(MAIL_CC);

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $body = '';
            foreach ($data as $key =>$value){
                if (!empty($value)&&$key!='tos'){
                    $body .=$key.': '.$value.'</br>';
                }
            }
            $mail->Body = $body;
            $mail->send();
        } catch (Exception $e) {
            exit('Error sending email: '.$e->getMessage());
        }
    }
}
