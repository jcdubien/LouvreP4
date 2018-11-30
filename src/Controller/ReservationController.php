<?php

namespace App\Controller;


use App\Entity\Orderlouvre;
use App\Form\OrderType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ReservationController extends AbstractController
{


    private $payment;

    /**
     * @Route ("/reservation", name="reservation")
     */
    public function order(Request $request , ObjectManager $manager)

    {
        $order=new Orderlouvre();

        $form=$this->createForm(OrderType::class,$order);

        $form->handleRequest($request);





        if($form->isSubmitted() && $form->isValid())
            {



            if(!$order->getId())
                {
                    $order->setDateOrder(new \DateTime());
                    $order->setTotalPrice(1);
                    $order->setReference('TEST');
                }

            $_SESSION['orderPrice']=$order->getTotalPrice();

            dump($_SESSION['order']);


                /*
                 * ajouter utilsation achat apres stockage en session .....
                 */
            $manager->persist($order);
            $manager->flush();

            $this->addFlash('success','Vos billets ont  bien été ajoutés !');

            return $this->redirectToRoute('payment_success');



            }

        return $this->render('reservation/index.html.twig',
            [
                'formOrder'=>$form->createView(),
                'controller_name'=>'Passer une commande ...'
            ]);


    }
}








