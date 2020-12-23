<?php

namespace App\Controller;

use App\DTO\Email;
use App\Service\EmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    private EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * @Route("/email", name="email")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(Email::class, new Email());
        if ($form->isSubmitted() && $form->isValid()) {

            $userModel = $form->getData();
            dd($userModel);
        }

        return $this->render('email/sent_email.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function sent()
    {
        $this->emailService->sent();
    }
}
