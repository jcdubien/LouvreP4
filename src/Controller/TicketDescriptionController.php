<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TicketDescriptionController extends AbstractController
{
    /**
     * @Route("/ticket/description", name="ticket_description")
     */
    public function index()
    {
        return $this->render('ticket_description/index.html.twig', [
            'controller_name' => 'TicketDescriptionController',
        ]);
    }
}
