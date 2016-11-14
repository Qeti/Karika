<?php

namespace Karika\CoreBundle\Entity\Manager;

use Doctrine\ORM\Decorator\EntityManagerDecorator;

/**
 * Default Entity Manager for API
 */
class ApiEntityManager extends EntityManagerDecorator
{

    /**
     * @param string $entityClassName
     */
    public function createEntity(string $entityClassName, $values = [])
    {
        $entity = new $entityClassName;

        foreach ($values as $key => $value)
        {
            $entity->{'set' . ucfirst($key)}($value);
        }

        return $entity;
    }
}