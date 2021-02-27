<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends AbstractController
{

    public function __construct()
    {

    }

    /**
     * @Route("/articles", name="articles.list")
     * @return Response
     */

    public function list(): Response{
        return $this->render("pages/articles.html.twig");
    }
}