<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Humano;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class HumanoFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $humano1 = new Humano();
        $humano1->setRut('17358794-5');
        $humano1->setNombre('Tomás Vargas');
        $manager->persist($humano1);

        $humano2 = new Humano();
        $humano2->setRut('17532681-2');
        $humano2->setNombre('Daniela Vega');
        $manager->persist($humano2);

        $humano3 = new Humano();
        $humano3->setRut('17125163-K');
        $humano3->setNombre('Rodolfo Vargas');
        $manager->persist($humano3);
        
        $manager->flush();
    }
}