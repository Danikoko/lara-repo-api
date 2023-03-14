<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactRepository implements ContactRepositoryInterface
{
    public function sendContactMail(array $contactDetails): JsonResponse
    {
        $mailFromAddress = env('MAIL_FROM_ADDRESS');
        $mailSent = Mail::to(env('DEVELOPER_EMAIL'))->send(new ContactMail($contactDetails, $mailFromAddress));
        if ($mailSent) {
            return response()->json([
                'status' => 'success',
                'message' => 'Contact mail has been sent successfully. You\'d receive a response soon!'
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'The mail couldn\'t be sent.'
            ], 401);
        }
    }
}
