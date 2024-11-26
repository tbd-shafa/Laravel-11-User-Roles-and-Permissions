<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact.form');
    }


    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.brevo.com';
            $mail->SMTPAuth = true;
            $mail->Username = '789677002@smtp-brevo.com';
            $mail->Password = 'xsmtpsib-f5a5f0b15bf01cfa4a13723972abe13bfafd0d9bec31ad14e77a2c4326206ed1-g2YQ8sDtHGMJRwNk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($request->email, $request->name);
            $mail->addAddress('shafa@technobd.com');
            $mail->isHTML(true);
            $mail->Subject = "Contact Form Submission from {$request->name}";
            $mail->Body = "
                <h2>Contact Form Submission</h2>
                <p><strong>Name:</strong> {$request->name}</p>
                <p><strong>Email:</strong> {$request->email}</p>
                <p><strong>Message:</strong></p>
                <p>{$request->message}</p>
            ";

            $mail->send();
            return redirect()->back()->with('success', 'Message sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to send the message: ' . $mail->ErrorInfo);
        }
    }
}
i