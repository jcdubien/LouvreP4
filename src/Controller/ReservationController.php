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

            /*if(!$order->getId())
                {
                    $order->setDateOrder(new \DateTime());
                    $order->setTotalPrice(1);
                    $order->setReference('TEST');
                }

            /*$_SESSION['orderPrice']=$order->getTotalPrice();*/

            $this->get('session')->set('orderPrice',$order->getTotalPrice());
                 /*
                 * ajouter utilsation achat apres stockage en session .....
                 */
            /*$manager->persist($order);
            $manager->flush();*/

            $this->addFlash('success','Vos billets ont  bien été ajoutés !');




            return $this->render('view_recap_order/index.html.twig', [
                'tickets'=>$order->getTicketLouvre(),
                'controller_name' =>'Recapitulatif de la commande'
            ]);



            }

        return $this->render('reservation/index.html.twig',
            [
                'formOrder'=>$form->createView(),
                'totalPrice'=>$order->getTotalPrice(),
                'controller_name'=>'Passer une commande ...'
            ]);


    }
}








