<?php
/**
 * Created by PhpStorm.
 * User: jcdub
 * Date: 11/11/2018
 * Time: 22:00
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaymentSuccess extends AbstractController
{
    /**
     * @Route("/payment/success", name="payment_success")
     */
    public function PaymentSuccess()

    {
        return $this->render('payment_success.twig',
            [

                'controller_name' => 'Paiement accepté',
                ''
            ]);
    }
}