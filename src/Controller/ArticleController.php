<?php


namespace App\Controller;


use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{

    /**
     * @var ArticlesRepository
     */
    private $repository;

    public function __construct(ArticlesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/article", name="articles.list")
     * @return Response
     */

    public function list(): Response{
        $articles = $this->repository->findAll();

        return $this->render("pages/articles.html.twig", [
            'articles' => $articles
        ]);
    }
}