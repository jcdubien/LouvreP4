<?php

namespace App\Controller;

use App\Entity\Orderlouvre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    const AGE_CHILD = 4;
    const AGE_TEEN = 12;
    const AGE_OLD = 60;

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $order=new Orderlouvre();



        return $this->render(
            'index/index.html.twig',
            [
            'controller_name' => 'Accueil et présentation des activités',
            ]
        );
    }
}
