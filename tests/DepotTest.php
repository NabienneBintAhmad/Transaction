<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepotTest extends WebTestCase
{
    public function testSomething()
    {   
        $client = static::createClient([],[
        'PHP_AUTH_USER'=>'caissier2@gmail.com',
        'PHP_AUTH_PW'=>'passer1'
     ]);
    
        $crawler = $client->request('POST', '/api/depot',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{
            "compte":30,
            "caissier":20,
            "montant":75000
        }'
    );
        $rep = $client->getResponse();
         var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }

}