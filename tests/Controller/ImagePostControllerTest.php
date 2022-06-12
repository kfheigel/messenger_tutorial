<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImagePostControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $uploadedFile = new UploadedFile(
            __DIR__.'/../Fixtures/test.webp',
            'test.webp'
        );

        $client->request('POST', '/api/images', [], [
            'file' => $uploadedFile
        ]);

        $this->assertResponseIsSuccessful();

        /** InMemoryTransport $transport */
        $transport = self::$container->get('messenger.transport.async_priority_high');
        $this->assertCount(1, $transport->get());

        dd($transport);
    }
}
