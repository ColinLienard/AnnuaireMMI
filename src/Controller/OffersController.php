<?php


namespace App\Controller;


use App\Entity\Offer;
use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffersController extends AbstractController
{
    /**
     * @var OfferRepository
     */
    private $repository;


    /**
     * OffersController constructor.
     * @param OfferRepository $repository
     */
    public function __construct(OfferRepository $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @Route ("/offre", name="offer.list")
     * @return Response
     */

    public function list(): Response{
        $offers = $this->repository->findAll();

        return $this->render("pages/offer/offerList.html.twig", [
            'offers' => $offers
        ]);
    }


    /**
     * @Route ("/offre/{id}", name="offer.show")
     * @param Offer $offer
     * @return Response
     */
    public function show(Offer $offer): Response{
        return $this->render('pages/offer/offerShow.html.twig', [
            'offer' => $offer
        ]);
    }
}