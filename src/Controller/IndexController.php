<?php

namespace App\Controller;


use App\Entity\Orderlouvre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $order=new Orderlouvre();

        $this->addFlash('success','Vos billets ont  bien été ajoutés !');

        return $this->render('index/index.html.twig', [
            'controller_name' => 'Accueil et présentation des activités',
        ]);
    }
}
