<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

use App\Models\Subscribe;
use App\Models\User;

class MailerController extends Controller
{
    public function sendNewLetter (Request $request)
    {
        $subject = $request->subject;
        $templates = $request->text;
        $mail = new PHPMailer(true);
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
        $mail->SMTPAutoTLS = true; 
        $mail->Port = 587;
        $mail->Username = 'werot.smtp.2@gmail.com';
        $mail->Password = 'Werot001';
        $mail->setFrom('info@werotboost.shop', 'Ales Werot');
        // $mail->addReplyTo('list@example.com', 'List manager');

        $mail->Subject = $subject;
        $mail->CharSet = "utf-8";
        // $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

        $emails = [];
        foreach(Subscribe::get() as $sub1){
            $emails[] = $sub1->email;
        }

        foreach(User::where('news_latter', 0)->get() as $sub2){
            $emails[] = $sub2->email;
        }

        foreach ($emails as $email) {
            $template = null;
            $template = str_replace("{email}", $email, $templates);
            $HTMLEmail = view('emails.subscription', compact('template'))->render();
            $mail->msgHTML($HTMLEmail);

            try {
                $mail->addAddress($email);
            } catch (Exception $e) {
                echo 'Invalid address skipped: ' . $email . '<br>';
                continue;
            }

            // if (!empty($row['photo'])) {
            //     //Assumes the image data is stored in the DB
            //     $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg');
            // }

            try {
                $mail->send();
            } catch (Exception $e) {
                echo 'Mailer Error (' . htmlspecialchars($email) . ') ' . $mail->ErrorInfo . '<br>';
                //Reset the connection to abort sending this message
                //The loop will continue trying to send to the rest of the list
                $mail->getSMTPInstance()->reset();
            }
            //Clear all addresses and attachments for the next iteration
            $mail->clearAddresses();
            $mail->clearAttachments();
        }
    }

    public function cancel (Request $request)
    {
        Subscribe::where('email', $request->email)->delete();
        return redirect('/');
    }
}
