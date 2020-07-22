<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param UserRepository $userRepository
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(UserRepository $userRepository, ProjectRepository $projectRepository)
    {
        $user = $userRepository->findOneBy([]);
        $projects = $projectRepository->findAll();

        return $this->render('home/index.html.twig', [
            'user' => $user,
            'projects' => $projects,
        ]);
    }
}
