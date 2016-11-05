<?php

namespace Karika\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KarikaUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}