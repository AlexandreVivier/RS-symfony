<?php

namespace App\Controller;

use App\Repository\FriendshipRequestsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FriendshipRequests;
use App\Entity\User;

class FriendshipController extends AbstractController
{
    #[Route('/friendship', name: 'app_friendship')]
    public function index(FriendshipRequestsRepository $friendshipRequestsRepository): Response
    {
        // montrer tous les amis de l'utilisateur connecté :

    $user = $this->getUser();
    
    $friends = $friendshipRequestsRepository->findBy(
        ['giver' => $user],
        ['created_at' => 'DESC']
    );


   
    // dd($friends);   

        return $this->render('friendship/index.html.twig', [
            'friends' => $friends,
        ]);
    }

    #[Route('/send-request', name: 'app_send_friendship')]
    public function sendRequest(): Response
    {

        return $this->render('friendship/send_request.html.twig', [
            'controller_name' => 'FriendshipController',
        ]);
    }
}
