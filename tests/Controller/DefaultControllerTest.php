<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testNotLoggedHomepage()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertSelectorExists('label', 'Mot de passe');
    }

    public function testLoggedHomepage()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $client->request('GET', '/');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('h1', 'Bienvenue');
    }
}