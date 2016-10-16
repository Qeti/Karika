<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Product;

class LoadProductData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $entity = new Product();
        $entity->setName('Hammer');
        $entity->setDescription('Традиционный молоток');
        $entity->setPrice(100.01);
        $manager->persist($entity);

        $entity = new Product();
        $entity->setName('Nail');
        $entity->setDescription('Standard nail');
        $entity->setPrice(1.01);
        $manager->persist($entity);

        for ($i = 100; $i > 0; $i--)
        {
            $entity = new Product();
            $entity->setName('Product ' . $i);
            $entity->setDescription('Description for product ' . $i);
            $entity->setPrice($i / 7);
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
