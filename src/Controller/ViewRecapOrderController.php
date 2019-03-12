<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ViewRecapOrderController extends AbstractController
{
    /**
     * @Route("/view/recap/order", name="view_recap_order")
     */
    public function index()
    {
        return $this->render(
            'view_recap_order/index.html.twig',
            [
            'controller_name' => 'ViewRecapOrderController',
            ]
        );
    }
}
