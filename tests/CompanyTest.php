<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\DataFixtures\AppFixtures;
use Liip\TestFixturesBundle\Test\LoadFixturesTrait;

class CompanyTest extends WebTestCase
{
    use LoadFixturesTrait;

    public function setUp(): void
    {
        parent::setUp();
        $this->loadFixtures([
            AppFixtures::class,
        ]);
    }
    public function testRenderTemplate(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/'); // Replace with your actual route
        self::assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testRenderTemplateWithData(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/companies');

        $response = $crawler->getResponse();        

        self::assertResponseIsSuccessful();
        
        self::assertSelectorTextContains('th', 'Company Name');
        self::assertSelectorTextContains('th', 'Total Sales');
        self::assertSelectorTextContains('td', 'Company 1');
        self::assertSelectorTextContains('td', 5000.00);
    }
}
