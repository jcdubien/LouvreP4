<?php

namespace App\Controller;

use App\Entity\Orderlouvre;
use App\Form\OrderType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    private $payment;

    /** @var SessionInterface */
    protected $session;

    /** @var  FormFactoryInterface */
    protected $formFactory;

    public function __construct(SessionInterface $session, FormFactoryInterface $formFactory)
    {
        $this->session = $session;
        $this->formFactory = $formFactory;
    }

    /**
     * @Route ("/reservation", name="reservation")
     */
    public function order(Request $request, ObjectManager $manager)
    {
        $order = new Orderlouvre();
        $form = $this->formFactory->create(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($order->getTotalPrice() <= 0) {
                $this->addFlash('error', 'Le montant ne peut pas être nul !');
                return $this->redirectToRoute('reservation');
            } else {
                $this->session->set('orderPrice', $order->getTotalPrice());
                $this->session->set('order', $order);
                $this->session->set('afficheFlash', true);
                $this->session->getFlashBag()->add('success', 'Vos billets ont bien été ajoutés !');
                return $this->redirectToRoute('view_recap_order');
            }
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
