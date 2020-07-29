<?php

namespace App\Tests\Entity;

use DateTime;
use App\Entity\Task;
use App\Entity\User;
use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TaskTest extends KernelTestCase
{
    use FixturesTrait;
    
    private $task;

    public function setUp(): void
    {
        self::bootKernel();
        $this->task = new Task();
        $this->task->setTitle('Un titre au hasard');
        $this->task->setContent('Un contenu au hasard');
    }

    public function testGetId()
    {
        $this->assertNull($this->task->getId());
    }

    public function testGetTitle()
    {
        $this->assertSame('Un titre au hasard', $this->task->getTitle());
    }

    public function testGetContent()
    {
        $this->assertSame('Un contenu au hasard', $this->task->getContent());
    }

    public function testGetCreatedAt()
    {
        $this->assertInstanceOf(DateTime::class, $this->task->getCreatedAt());
    }

    public function testIsDone()
    {
        $this->assertFalse($this->task->isDone());
    }

    public function testGetUser()
    {
        $this->task->setUser(new User());
        $this->assertInstanceOf(User::class, $this->task->getUser());
    }

    public function testValidEntity()
    {
        $error = self::$container->get('validator')->validate($this->task);
        $this->assertCount(0, $error);
    }
    
    public function testInvalidEmptyTitle()
    {
        $this->task->setTitle('');
        $error = self::$container->get('validator')->validate($this->task);
        $this->assertCount(1, $error);
    }

    public function testInvalidUsedTitle()
    {
        $this->loadFixtures([AppFixtures::class]);
        $this->task->setTitle('titre');
        $error = self::$container->get('validator')->validate($this->task);
        $this->assertCount(1, $error); 
    }

    public function testInvalidEmptyContent()
    {
        $this->task->setContent('');
        $error = self::$container->get('validator')->validate($this->task);
        $this->assertCount(1, $error);
    }

    public function testDefaultIsDoneFalse()
    {
        $this->assertSame(false, $this->task->isDone());
    }

    public function testIsDoneTrue()
    {
        $this->task->toggle(true);
        $this->assertSame(true, $this->task->isDone());
    }

    public function testIsDoneFalse()
    {
        $this->task->toggle(false);
        $this->assertSame(false, $this->task->isDone());
    }

    public function testValidUser()
    {
        $this->task->setUser(new User());
        $this->assertInstanceOf(User::class, $this->task->getUser());
    }

    public function testValidCreatedAt()
    {
        $this->task->setCreatedAt(new \DateTime());
        $this->assertInstanceOf(DateTime::class, $this->task->getCreatedAt());
    }

}