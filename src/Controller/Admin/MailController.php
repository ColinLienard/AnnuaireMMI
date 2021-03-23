<?php


namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\MailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MailController extends AbstractController
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    private $mailer;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, MailerInterface $mailer)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }

    /**
     * @Route ("/admin/mail", name="mail")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response{

        $form = $this->createForm(MailType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = new User();

            $chaine = ('0123456789abcdefghijklmnopkrstuvwxyz');
            $ref = md5(substr($chaine, rand(0, 36), rand(0, 36)));

            $user->setPassword($this->passwordEncoder->encodePassword($user,$ref));
            $user->setEmail($form["email"]->getData());
            $user->setIsEduc($form["isEduc"]->getData());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            /*$email = (new Email())
                ->from('hello@example.com')
                ->to($form["email"]->getData())
                ->subject($ref)
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');

            $this->mailer->send($email); */


        }

        return $this->render('security/mail.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}