<?php
/**
 * Created by PhpStorm.
 * User: jcdub
 * Date: 17/03/2019
 * Time: 23:02
 */

namespace App\Tests\Entity;

use App\src\Entity\Orderlouvre;
use Faker\Factory;
use PHPUnit\Framework\TestCase;


class OrderlouvreTest extends TestCase

{

    public function testSetReference()
    {
        $order=new Orderlouvre();
        $result=$order->setReference('azerty');

        $this->assertEquals($order->getReference(),$result);
    }

    public function testSetDateOrder()
    {
        $order=new Orderlouvre();
        $faker=Factory::create();
        $result=$order->setDateOrder($faker->dateTimeThisCentury);

        $this->assertEquals($order->getDateOrder(),$result);
    }

    public function testSetFirstName()
    {
        $order=new Orderlouvre();
        $faker=Factory::create();
        $result=$order->setFirstName($faker->firstNameFemale);


        $this->assertEquals($order->getFirstName(),$result);
    }


}
