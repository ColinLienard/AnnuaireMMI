<?php


namespace App\Controller;



use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{


    /**
     * @Route("/profile",name="profil")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response{


        #$form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('pages/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}