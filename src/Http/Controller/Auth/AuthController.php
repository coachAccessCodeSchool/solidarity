<?php

namespace App\Http\Controller\Auth;

use App\Domain\User\AuthService;
use App\Domain\User\User;
use App\Http\Form\Auth\RegisterType;
use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('auth/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new LogicException(
            'This method can be blank - it will be intercepted by the logout key on your firewall.'
        );
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->authService->register($user);
            $this->addFlash('success', 'Compte créer, vous pouvez vous connecter');
            return $this->redirect('login');
        }
        return $this->render('auth/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
