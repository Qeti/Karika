<?php

namespace Karika\CoreBundle;

use Karika\CoreBundle\DependencyInjection\KarikaCoreExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class KarikaCoreBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new KarikaCoreExtension();
    }
}
