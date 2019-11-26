<?php

namespace App\Controller\GAME;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\UserByCampagne;
use App\Entity\Campagne;
use App\Entity\Chat;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
  /**
   * @Route("/", name="game")
   */
    public function index()
    {
      $this->denyAccessUnlessGranted('ROLE_USER');
      $entityManager = $this->getDoctrine()->getManager();
      $user = $this->getUser();
    //  $list_Campagne_started = $entityManager->getRepository(UserByCampagne::class)->findBy(['id_user' => $user->getId()]);
      $lesCampagnes = $entityManager->getRepository(Campagne::class)->find(1);
      if($lesCampagnes != null) {
        $list_Campagne_started = $lesCampagnes->getCampagneByUser()->toArray();
      } else {
          $list_Campagne_started = [];
      }
      $list_Campagne = $entityManager->getRepository(Campagne::class)->findAll();

      $entityManager = $this->getDoctrine()->getManager();
      $getuser = $entityManager->getRepository(User::class)->find($user);

        return $this->render('game/index.html.twig', [
            'list_campagne' => $list_Campagne,
            'list_campagne_started' =>$list_Campagne_started,
            'user'=> $user
        ]);
    }
    /**
     * @Route("/new", name="newgame",methods="POST")
     */
      public function new(Request $request)
      {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $entityManager = $this->getDoctrine()->getManager();
        $campagne = $entityManager->getRepository(Campagne::class)->find($request->request->get('IdCampagne'));
        $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
        $usercampagne = new UserByCampagne();
        $chat = new Chat();
        $usercampagne->setIdCampagne($campagne);
        $usercampagne->setIdUser($user);
      //  $usercampagne->setDescription('Ergonomic and stylish!');
        $entityManager->persist($usercampagne);
        $entityManager->flush();
        return $this->render('game/chat.html.twig',);
      }

    /**
     * @Route("/chat", name="chat",methods={"GET", "POST"}, requirements={"user "="\d+"})
     */
      public function chat()
      {
        $entityManager = $this->getDoctrine()->getManager();
        $message = $entityManager->getRepository(Stats::class)->findByUser($user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }
          return $this->render('game/index.html.twig', [
              'controller_name' => 'GameController',
          ]);
      }

    /**
     * @Route("/profile/{id}", name="profile",methods={"GET"}, requirements={"id"="\d+"})
     */
      public function profile(int $id)
      {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(Stats::class)->findByUser($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

          return $this->render('game/profile.html.twig', [
              'user' => $user,
          ]);
      }
}
