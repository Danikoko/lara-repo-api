<?php

namespace App\Http\Controllers;

use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    private ContactRepositoryInterface $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function sendContactMail(ContactRequest $request)
    {
        $validatedData = $request->validated();
        return $this->contactRepository->sendContactMail($validatedData);
    }
}
