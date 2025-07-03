<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\Attributes\TestWith;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    #[TestWith(['/'])]
    #[TestWith(['/modern'])]
    #[TestWith(['/view.php?id=4'])]
    public function testPage(string $path): void
    {
        $client = static::createClient();
        $client->request('GET', $path);

        static::assertResponseIsSuccessful();
    }
}
