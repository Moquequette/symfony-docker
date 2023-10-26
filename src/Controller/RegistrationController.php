<?php
namespace App\Controller;

use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;


class RegistrationController extends AbstractController
{
    #[Route('/register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, FormFactoryInterface $formFactory): Response
    {
        $form = $formFactory->create(RegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Form is submitted and valid, process registration here
            $user = new User(); // Replace with your User entity

            // Get the user data from the form
            $formData = $form->getData();
            $user->setEmail($formData['email']);
            $user->setRoles($formData['roles']);
            $user->setPassword($passwordHasher->hashPassword($user, $formData['password']));

            return $this->redirectToRoute('/login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/login')]
    public function login(): Response
    {
        return $this->json([
            'message' => 'on va login',
        ]);
    }
}
