<?php

namespace App\Controller;

use App\Entity\Orderlouvre;
use App\Service\StripeHelper;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PaymentValidationController extends AbstractController
{
    /**
     * @Route("/payment/validation", name="payment_validation")
     */
    public function index(Request $request, ObjectManager $manager ,StripeHelper $stripehelper)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys

        \Stripe\Stripe::setApiKey("sk_test_gynVsKxbFbKVb6Iahr2kNPrW");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:

        if ($request->isMethod('POST')) {

            /**
             * @var Orderlouvre $order
             */
            $order = $this->get('session')->get('order');
            $now = new \DateTime();
            $reference = md5($now->format('d-m-Y H:i:s'));
            $order->setDateOrder($now);
            $order->setReference($reference);
            return $this->AssignPaymentStripe($request, $order, $stripehelper);
        }



        return $this->render(
            'payment_validation/index.html.twig',
            [
                'controller_name' => 'Paiement'
                ]
        );
    }

    public function AssignPaymentStripe(Request $request, Orderlouvre $order, StripeHelper $stripeHelper)
    {

        $manager=$this->getDoctrine()->getManager();
        $error=$stripeHelper->paymentAction($request , $order);

        if (!$error) {
            $manager->persist($order);
            $manager->flush();
            return $this->redirectToRoute('email');
        } else {
            return $this->redirectToRoute('error');
        }
    }
}
