<?php

namespace Karika\ExampleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Karika\CoreBundle\Entity\ProductSuperclass;

/**
 * Product
 *
 * @ORM\Entity(repositoryClass="Karika\CoreBundle\Repository\ProductRepository")
 */
class Product extends ProductSuperclass
{

}
