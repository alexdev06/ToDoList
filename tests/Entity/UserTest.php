<?php

namespace App\Tests\Entity;

use App\Entity\Task;
use App\Entity\User;
use App\DataFixtures\AppFixtures;
use Doctrine\Common\Collections\Collection;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    use FixturesTrait;
    
    private $user;

    public function setUp(): void
    {
        self::bootKernel();
        $this->user = new User();
        $this->user->setUsername('Alexandre');
        $this->user->setEmail('alexandre@gmail.com');
        $this->user->setPassword('123456789');
    }

    public function testGetId()
    {
        $this->assertNull($this->user->getId());
    }

    public function testGetUsername()
    {
        $this->assertSame('Alexandre', $this->user->getUsername());
    }

    public function testGetEmail()
    {
        $this->assertSame('alexandre@gmail.com', $this->user->getEmail());
    }

    public function testGetPassword()
    {
        $this->assertSame('123456789', $this->user->getPassword());
    }

    public function testNoTasks()
    {
        $this->assertEmpty($this->user->getTasks());
    }

    public function testAddTasks()
    {
        $taskStub = $this->createMock(Task::class);
        $this->user->addTask($taskStub);
        $this->assertInstanceOf(Collection::class, $this->user->getTasks());
    }

    public function testRemoveTask()
    {
        $taskStub = $this->createMock(Task::class);
        $this->user->addTask($taskStub);
        $taskStub->method('setUser');
        $taskStub->method('getUser')->willReturn($this->user);
        $this->user->removeTask($taskStub);
        $this->assertEmpty($this->user->getTasks());
    }

    public function testValidEntity()
    {
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(0, $error);
    }

    public function testInvalidEmptyUsername()
    {
        $this->user->setUsername('');
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error);
    }

    public function testInvalidTooShortUsername()
    {
        $this->user->setUsername('j');
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error);
    }

    public function testInvalidTooLongUsername()
    {
        $this->user->setUsername('jflsqjflmqjfmqlfjqmfjqslmfjqkfqshfkqjhfkjqhfkqhsfdkjhqfsdjkfhqksfjhqksfqsf');
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error);
    }

    public function testInvalidEmptyEmail()
    {
        $this->user->setEmail('');
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error); 
    }
    
    public function testInvalidEmptyPassword()
    {
        $this->user->setPassword('');
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error); 
    }

    /**
     * @dataProvider invalidEmailFormats
     */
    public function testInvalidFormatEmail($formats)
    {
        $this->user->setEmail($formats);
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error); 
    }
    
    public function invalidEmailFormats()
    {
        return [
            ['alexandre@gmail'],
            ['alexandre.@gmail'],
            ['alexandre..bla@gmail'],
            ['alexandreàgmail.com'],
            ['alexandre@gmaillkjdflgkjsd']
        ];
    }

    public function testDefaultRoleUser()
    {
        $this->assertSame(['ROLE_USER'], $this->user->getRoles());
    }

    public function testInvalidUsedUsername()
    {
        $this->loadFixtures([AppFixtures::class]);
        $this->user->setUsername('alex06');
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error); 
    }

    public function testInvalidUsedEmail()
    {
        $this->loadFixtures([AppFixtures::class]);
        $this->user->setEmail('alex06@gmail.com');
        $error = self::$container->get('validator')->validate($this->user);
        $this->assertCount(1, $error); 
    }

}