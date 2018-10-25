<?php

namespace App\Controller;

use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $order=new Order();

        return $this->render('index/index.html.twig', [
            'controller_name' => 'Accueil et présentation des activités',
        ]);
    }
}
