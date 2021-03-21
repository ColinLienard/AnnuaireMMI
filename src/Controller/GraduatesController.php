<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GraduatesController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @Route("/diplome", name="graduate.list")
     * @return Response
     */
    public function list(): Response{
        $graduates = $this->repository->findBy(array("isEduc"=>false));

        return $this->render("pages/graduate/graduateList.html.twig", [
            'graduates' => $graduates
        ]);
    }

    /**
     * @Route("/diplome/{id}/{slug}", name="graduate.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param User $graduate
     * @param string $slug
     * @return Response
     */
    public function show(User $graduate,string $slug): Response{
        if($graduate->getSlug() !== $slug){
            return $this->redirectToRoute('graduate.show',[
                'id' => $graduate->getId(),
                'slug' => $graduate->getSlug(),
            ], 301);
        }

        return $this->render('pages/graduate/graduateShow.html.twig', [
            'graduate' => $graduate
        ]);
    }
}