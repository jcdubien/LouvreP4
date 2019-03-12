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
    public function order(Request $request, ObjectManager $manager)
    {
        $order=new Orderlouvre();
        $form=$this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($order->getTotalPrice() <= 0) {
                $this->addFlash('error', 'Le montant ne peut pas être nul !');
                return $this->redirectToRoute('reservation');
            }
            $this->get('session')->set('orderPrice', $order->getTotalPrice());
            $this->get('session')->set('order', $order);
            $this->get('session')->set('afficheFlash', true);
            $this->addFlash('success', 'Vos billets ont  bien été ajoutés !');

            return $this->render(
                'view_recap_order/index.html.twig',
                [
                'tickets'=>$order->getTicketLouvre(),
                'controller_name' =>'Recapitulatif de la commande'
                ]
            );
        } else {
            $flashBag = $this->get('session')->getFlashBag();
            foreach ($flashBag->keys() as $type) {
                $flashBag->set($type, array());
            }
            $this->get('session')->set('afficheFlash', false);
        }

        return $this->render(
            'reservation/index.html.twig',
            [
            'formOrder'=>$form->createView(),
            'totalPrice'=>$order->getTotalPrice(),
            'controller_name'=>'Passer une commande ...'
            ]
        );
    }
}
