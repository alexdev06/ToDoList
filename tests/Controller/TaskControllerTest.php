<?php

namespace App\Tests\Controller;

use App\Entity\Task;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase 
{
    public function testUserNotLoggedList()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }

    public function testUserLoggedList()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $client->request('GET', '/tasks');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testUserNotAuthentifiedDoneList()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks/done');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }

    public function testUserAuthentifiedDoneList()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $client->request('GET', '/tasks/done');
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }
    
    public function testUserNotLoggedCreate()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks/create');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }

    public function testUserLoggedCreate()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $crawler = $client->request('GET', '/tasks/create');
        $form = $crawler->selectButton('Ajouter')->form([
            'task[title]' => 'un test',
            'task[content]' => 'un contenu'
        ]);
        $client->submit($form);
        $this->assertResponseRedirects('/tasks', 302);
        $crawler = $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
    }

    public function testUserNotLoggedRemove()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks/3/delete');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }

    public function testByCreatorRemove()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'ludo06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $taskrepo = $entityManager->getRepository(Task::class);
        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(['username' => 'ludo06']);
        $task = $taskrepo->findOneBy(['user' => $user])->getId();
        $client->request('GET', '/tasks/'.$task.'/delete'); 
        $this->assertResponseRedirects('/tasks', Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
    }

    public function testNotByCreatorRemove()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $taskrepo = $entityManager->getRepository(Task::class);
        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(['username' => 'ludo06']);
        $task = $taskrepo->findOneBy(['user' => $user])->getId();
        $client->request('GET', "/tasks/$task/delete"); 
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN);
    }

    public function testAnonymousByAdminRemove()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $taskrepo = $entityManager->getRepository(Task::class);
        $taskanno = $taskrepo->findOneBy(['user' => null])->getId();
        $client->request('GET', '/tasks/'.$taskanno.'/delete'); 
        $this->assertResponseRedirects('/tasks', Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
    }

    public function testAnonymousByUserRemove()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'ludo06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $taskrepo = $entityManager->getRepository(Task::class);
        $taskanno = $taskrepo->findOneBy(['user' => null])->getId();
        $client->request('GET', '/tasks/'.$taskanno.'/delete');
        $this->assertResponseStatusCodeSame(Response::HTTP_FORBIDDEN); 
    }

    
    public function testUserNotLoggedEdit()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks/3/edit');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }
    
    public function testUserLoggedEdit()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
            ]);
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $taskRepo = $entityManager->getRepository(Task::class);
        $taskId = $taskRepo->findOneBy(['user' => null])->getId();
        $crawler = $client->request('GET', "/tasks/$taskId/edit");
        $form = $crawler->selectButton('Modifier')->form([
            'task[title]' => 'un test modifié',
            'task[content]' => 'un autre contenu'
            ]);
        $client->submit($form);
        $this->assertResponseRedirects('/tasks', Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
    }

    public function testUserNotLoggedToggle()
    {
        $client = static::createClient();
        $client->request('GET', '/tasks/3/toggle');
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('label', 'Mot de passe');
    }
    
    public function testUserLoggedToTerminatedToggle()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
            ]);
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $taskRepo = $entityManager->getRepository(Task::class);
        $taskId = $taskRepo->findOneBy(['isDone' => false])->getId();
        $client->request('GET', "/tasks/$taskId/toggle");
        $this->assertResponseRedirects('/tasks', Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
    }
        
    public function testUserLoggedToNotTerminatedToggle()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'alex06',
            'PHP_AUTH_PW'   => 'password'
        ]);
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $taskRepo = $entityManager->getRepository(Task::class);
        $taskId = $taskRepo->findOneBy(['isDone' => true])->getId();
        $client->request('GET', "/tasks/$taskId/toggle");
        $this->assertResponseRedirects('/tasks', Response::HTTP_FOUND);
        $client->followRedirect();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertSelectorExists('.alert-success');
    }
}