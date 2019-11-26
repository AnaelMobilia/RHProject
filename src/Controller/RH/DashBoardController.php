<?php

namespace App\Controller\RH;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/dashboard")
 */
class DashBoardController extends AbstractController
{
  /**
   * @Route("/", name="dash_board")
   */
    public function index()
    {
        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }

    /**
     * @Route("/admin", name="admin")
     */
      public function admin()
      {
          return $this->render('dash_board/index.html.twig', [
              'controller_name' => 'DashBoardController',
          ]);
      }

      /**
       * @Route("/addCompetence", name="addCompetence")
       */
        public function addCompetence()
        {
            return $this->render('dash_board/index.html.twig', [
                'controller_name' => 'DashBoardController',
            ]);
        }

        /**
         * @Route("/addPointbyCompetence", name="addPointbyCompetence")
         */
          public function addPointbyCompetence()
          {
              return $this->render('dash_board/index.html.twig', [
                  'controller_name' => 'DashBoardController',
              ]);
          }

}
