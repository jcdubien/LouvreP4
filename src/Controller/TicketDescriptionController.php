<?php

namespace App\Controller;

use App\Entity\TicketLouvre;
use App\Form\TicketType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TicketDescriptionController extends AbstractController
{
    /**
     * @Route("/ticket/description", name="ticket_description")
     */
    public function ticket(Request $request, ObjectManager $manager)
    {
        $ticket=new TicketLouvre();

        $form=$this->createForm(TicketType::class, $ticket);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('view_recap_order');
        }

        return $this->render(
            'ticket_description/index.html.twig',
            [
            'formTicket'=>$form->createView(),
            'controller_name'=>"Description d'un billet"

            ]
        );
    }
}
