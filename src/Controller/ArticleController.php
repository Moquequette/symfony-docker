<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use DateTimeImmutable;

#[Route('/article')]
class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Bienvenue a article !',
            'path' => 'src/Controller/ArticleController.php',
        ]);
    }

    #[Route('/cree', name: 'app_article_cree', methods: ['GET'])]
    public function createArticle(EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $article->setTitre('Mon super 1er article')
            ->setEtat(true)
            ->setDate(new DateTimeImmutable());

        $entityManager->persist($article);
        $entityManager->flush();

        return new Response('Saved new article' . $article->getId());
    }

    #[Route('/voir/{id}', name: 'app_article_voir', methods: ['GET'])]
    public function articleVoir(EntityManagerInterface $entityManager, int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id' . $id
            );
        }

        return $this->render('article/index.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/modifier/{id}', name: 'app_article_modifier', methods: ['GET'])]
    public function updateArticle(EntityManagerInterface $entityManager, Request $request, int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id' . $id
            );
        }

        $entityManager->flush();

        return new Response('Updated article with ID ' . $article->getId());
    }

    #[Route('/supprimer/{id}', name: 'app_article_supprimer', methods: ['GET'])]
    public function deleteArticle(EntityManagerInterface $entityManager, int $id): Response
    {
        $article = $entityManager->getRepository(Article::class)->find($id);

        if (!$article) {
            throw $this->createNotFoundException(
                'No product found for id' . $id
            );
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return new Response('Deleted article with ID ' . $id);
    }
}
