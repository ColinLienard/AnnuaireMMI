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
     * @Route("/article", name="article.list")
     * @return Response
     */

    public function list(): Response{
        $articles = $this->repository->findAll();

        return $this->render("pages/article/articleList.html.twig", [
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/article/{slug}-{id}", name="article.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Articles $article
     * @param string $slug
     * @return Response
     */
    public function show(Articles $article,string $slug): Response{

        if($article->getSlug() !== $slug){
            return $this->redirectToRoute('article.show',[
                'id' => $article->getId(),
                'slug' => $article->getSlug(),
            ], 301);
        }

        return $this->render('pages/article/articleShow.html.twig', [
            'article' => $article
        ]);
    }
}