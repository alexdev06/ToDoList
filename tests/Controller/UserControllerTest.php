<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase 
{
    public function testUserNotLoggedList()
    {
        $client = static::createClient();
        $client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }

    public function testUserAuthentifiedList()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'ludo06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN); 
    }

    public function testAdminAuthentifiedList()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $client->request('GET', '/users');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testCreateUser()
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/users/create');
        $form = $crawler->selectButton('Ajouter')->form([
            'user[username]' => 'fred06',
            'user[roles]' => 'ROLE_USER',
            'user[password][first]' => 'password',
            'user[password][second]' => 'password',
            'user[email]' => 'fred06@gmail.com'
        ]);
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
        $this->assertSelectorExists('label', 'Mot de passe');
    }

    public function testUserAuthentifiedEditUser()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'ludo06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $em = $client->getContainer()->get('doctrine')->getManager();
        $userRepo = $em->getRepository(User::class);
        $user = $userRepo->findOneBy(['username' => 'alex06']);
        $userId = $user->getId();
        $client->request('GET', "/users/$userId/edit");
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN); 
    }

    public function testAdminAuthentifiedEditUser()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $em = $client->getContainer()->get('doctrine')->getManager();
        $userRepo = $em->getRepository(User::class);
        $user = $userRepo->findOneBy(['username' => 'ludo06']);
        $userId = $user->getId();
        $crawler = $client->request('GET', "/users/$userId/edit");
        $form = $crawler->selectButton('Modifier')->form([
            'user[username]' => 'ludo060',
            'user[roles]' => 'ROLE_USER',
            'user[password][first]' => 'password2',
            'user[password][second]' => 'password2',
            'user[email]' => 'fred060@gmail.com'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/users', Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
    }

    public function testNotLoggedEditUser()
    {
        $client = static::createClient();
        $em = $client->getContainer()->get('doctrine')->getManager();
        $userRepo = $em->getRepository(User::class);
        $user = $userRepo->findOneBy(['username' => 'alex06']);
        $userId = $user->getId();
        $client->request('GET', "/users/$userId/edit");
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }
}