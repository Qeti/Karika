<?php

namespace AppBundle\Document;

use FOS\OAuthServerBundle\Document\RefreshToken as BaseRefreshToken;
use FOS\OAuthServerBundle\Model\ClientInterface;

class RefreshToken extends BaseRefreshToken
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