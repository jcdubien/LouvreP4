<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;

class PaymentValidationController extends AbstractController
{
    /**
     * @Route("/payment/validation", name="payment_validation")
     */
    public function index(Request $request)
    {
        // Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey("sk_test_gynVsKxbFbKVb6Iahr2kNPrW");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:

        if ($request->isMethod('POST')) {


            $error=false;

            try {
                $token = $request->request->get('stripeToken');
                dump($token);

                $price = $this->get('session')->get('orderPrice', $request->getTotalPrice());

                \Stripe\Charge::create([
                    "amount" => $price,
                    "currency" => "eur",
                    "source" => "tok_mastercard", // obtained with Stripe.js
                    "description" => "Billet Louvre"
                ]);
            } catch(\Stripe\Error\Card $e) {

                $error = 'Il y a eu un problème avec votre carte '.$e->getMessage();

            }

            if (!$error) {
                //$this->get('shopping_cart')->emptyCart();
                $this->addFlash('success', 'Order Complete! Yay!');
                return $this->redirectToRoute('homepage');
            }

            //$this->get('session')->set('orderPrice',0);

            $this->addFlash('success', 'Votre règlement a bien été pris en compte , merci !');

        }

        $price=$this->get('session')->set('orderPrice',$request->getTotalPrice());

        \Stripe\Charge::create([
            "amount" => $price,
            "currency" => "eur",
            "source" => "tok_mastercard", // obtained with Stripe.js
            "description" => "Billet Louvre"
        ]);

        //$this->get('session')->set('orderPrice',0);

        $this->addFlash('success', 'Votre règlement a bien été pris en compte , merci !');




        return $this->render('payment_validation/index.html.twig', [

            'controller_name' => 'Paiement'
            
        ]);

    }
}
