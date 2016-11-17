<?php

namespace Karika\CoreBundle\Controller\Api;

use FOS\RestBundle\Controller\Annotations\RouteResource;

/**
 * Product controller.
 * @RouteResource("Product")
 */
class ProductController extends ApiController
{
    /**
     * @inheritdoc
     */
    protected function entityClassName(): string
    {
        return $this->container->getParameter('karika.entity.product_class');
    }
}
