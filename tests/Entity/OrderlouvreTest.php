<?php
/**
 * Created by PhpStorm.
 * User: jcdub
 * Date: 17/03/2019
 * Time: 23:02
 */

namespace App\Tests\Entity;


use App\Entity\Orderlouvre;
use Faker\Factory;
use PHPUnit\Framework\TestCase;


class OrderlouvreTest extends TestCase

{

    public function testSetReference()
    {
        $order=new Orderlouvre();

        $order->setReference('azerty');
        $result=$order->getReference();

        $this->assertEquals('azerty',$result);
    }

    public function testSetDateOrder()
    {
        $order=new Orderlouvre();
        $datetest=new \DateTime();
        $datetest->setDate(2020,3,15);

        $order->setDateOrder($datetest);
        $result=$order->getDateOrder();

        $this->assertEquals($datetest,$result);
    }

    public function testSetFirstName()
    {
        $order=new Orderlouvre();

        $order->setFirstName('Christelle');
        $result=$order->getFirstName();

        $this->assertEquals('Christelle',$result);
    }


}
