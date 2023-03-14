<?php

namespace App\Interfaces;

interface ContactRepositoryInterface
{
    public function sendContactMail(array $contactDetails);
}
