<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $entity = new User();
        $entity->setEmail('admin@test');
        $entity->setUsername('admin');
        $entity->setEnabled(true);
        $password = $this->container->get('security.password_encoder')
            ->encodePassword($entity, 'test');
        $entity->setPassword($password);
        $manager->persist($entity);

        $entity = new User();
        $entity->setEmail('manager@test');
        $entity->setUsername('manager');
        $entity->setEnabled(true);
        $password = $this->container->get('security.password_encoder')
            ->encodePassword($entity, 'test');
        $entity->setPassword($password);
        $manager->persist($entity);

        $manager->flush();
    }
}