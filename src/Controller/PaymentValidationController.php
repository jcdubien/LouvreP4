<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaymentValidationController extends AbstractController
{
    /**
     * @Route("/payment/validation", name="payment_validation")
     */
    public function index()
    {

        // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_gynVsKxbFbKVb6Iahr2kNPrW");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => 999,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
        ]);

        return $this->render('payment_validation/index.html.twig', [
            'controller_name' => 'PaymentValidationController',
        ]);
    }
}
