<?php


namespace App\Service;

use App\Entity\Orderlouvre;
use Symfony\Component\HttpFoundation\Request;

class StripeHelper
{
    public function paymentAction(Request $request, Orderlouvre $order)
    {

        try {
            $token = $request->request->get('stripeToken');
            $error = false;
            $price = $order->getTotalPrice();
            \Stripe\Charge::create(
                [
                "amount" => $price * 100,
                "currency" => "eur",
                "source" => "tok_mastercard", // obtained with Stripe.js
                "description" => "Billet Louvre"
                ]
            );
        } catch (\Stripe\Error\Card $e) {
            $error = 'Il y a eu un problème avec votre carte ' . $e->getMessage();
            $this->addFlash('error', 'Quelque chose s\'est mal passé ...');
        }

        return $error;
    }
}
