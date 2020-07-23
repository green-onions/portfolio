<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param UserRepository $userRepository
     * @param ProjectRepository $projectRepository
     * @param Request $request
     * @return Response
     */
    public function index(UserRepository $userRepository, ProjectRepository $projectRepository, Request $request)
    {
        $user = $userRepository->findOneBy([]);
        $projects = $projectRepository->findAll();

        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setIsRead(false);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('home');
        }

        return $this->render('home/index.html.twig', [
            'user'     => $user,
            'projects' => $projects,
            'form'     => $form->createView(),
        ]);
    }
}
