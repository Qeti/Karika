<?php

namespace Karika\CoreBundle\Document;

use FOS\OAuthServerBundle\Document\AuthCode as BaseAuthCode;
use FOS\OAuthServerBundle\Model\ClientInterface;

class AuthCode extends BaseAuthCode
{
    protected $id;
    protected $client;

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }
}