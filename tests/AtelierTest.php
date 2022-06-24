<?php

namespace App\Tests;

use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use function PHPUnit\Framework\assertEquals;

class AtelierTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);

    }
    public function testFindAllAtelier(): void
    {
        $kernel = self::bootKernel();
        $container = static::getContainer();
        $repository = $container->get(AtelierRepository::class);
        $atelier = $repository->findAll()[0];
        assertEquals("Atelier0", $atelier->getLibelle());
    }
}
