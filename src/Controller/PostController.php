<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findBy(
            ['author' => $this->getUser()],
            ['created_at' => 'DESC']
        );
        
    
        // dd($posts);
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/{id}', name: 'app_post_show')]
    public function show(int $id, PostRepository $postRepository): Response
    {
        $post = $postRepository->find($id);

        return $this->render('post/show.html.twig', [
            'id' => $id,
            'post' => $post,
        ]);
    }

    #[Route('/post/create', name: 'app_post_create')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
        $post = new Post();
        return $this->save($post, $request, $manager);
    }

     /**
     * @param Post $post
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    private function save(Post $post, Request $request, EntityManagerInterface $manager): Response
    {
        // Si l'utilisateur n'est pas connecté, on lui interdit l'accès
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setAuthor($this->getUser());

            $manager->persist($post);
            $manager->flush();
            dd($post);
   
            return $this->redirectToRoute('app_post_show', ['id' => $post->getId()]);
        }

        return $this->render('post/create.html.twig', [
            'form' => $form,
            'post' => $post
        ]);
    }



}
