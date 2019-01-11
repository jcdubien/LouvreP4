<?php

namespace App\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Tests\Fixtures\ToString;

class PaymentValidationController extends AbstractController
{
    /**
     * @Route("/payment/validation", name="payment_validation")
     */
    public function index(Request $request , ObjectManager $manager)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys

        \Stripe\Stripe::setApiKey("sk_test_gynVsKxbFbKVb6Iahr2kNPrW");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:

        if ($request->isMethod('POST'))

        {

            $error=false;
            $order=$this->get('session')->get('order');
            $now=new \DateTime();
            $reference=md5($now->format('d-m-Y H:i:s'));
            $order->setDateOrder($now);
            $order->setReference($reference);


            try
                {

                $token = $request->request->get('stripeToken');
                dump($token);
                $price = $this->get('session')->get('orderPrice');
                \Stripe\Charge::create
                    ([
                        "amount" => $price*100,
                        "currency" => "eur",
                        "source" => "tok_mastercard", // obtained with Stripe.js
                        "description" => "Billet Louvre"
                    ]);
                }

            catch(\Stripe\Error\Card $e)

                {

                    $error = 'Il y a eu un problème avec votre carte '.$e->getMessage();

                }

            if (!$error)

                {

                $this->addFlash('success', 'Commmande effectuée');
                $manager->persist($order);
                $manager->flush();
                return $this->redirectToRoute('index');

                }

        }

        return $this->render('payment_validation/index.html.twig', [

            'controller_name' => 'Paiement'
            
        ]);

    }
}
