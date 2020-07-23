<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use App\Repository\MessageRepository;
use App\Repository\ProjectRepository;
use App\Repository\SocialNetworkRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param UserRepository $userRepository
     * @param ProjectRepository $projectRepository
     * @param LanguageRepository $languageRepository
     * @param SocialNetworkRepository $networkRepository
     * @param MessageRepository $messageRepository
     * @return void
     */
    public function index(
        UserRepository $userRepository,
        ProjectRepository $projectRepository,
        LanguageRepository $languageRepository,
        SocialNetworkRepository $networkRepository,
        MessageRepository $messageRepository
    ): Response {
        $user      = $userRepository->findOneBy([]);
        $projects  = $projectRepository->findAll();
        $languages = $languageRepository->findAll();
        $networks  = $networkRepository->findAll();
        $messages  = $messageRepository->findBy(['isRead' => false]);

        return $this->render('admin/index.html.twig', [
            'user'      => $user,
            'projects'  => $projects,
            'languages' => $languages,
            'networks'  => $networks,
            'messages'  => $messages,
        ]);
    }
}
