<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DepotTest extends WebTestCase
{
    public function testSomething()
    {   
        $client = static::createClient([],[
        'PHP_AUTH_USER'=>'caissier5@gmail.com',
        'PHP_AUTH_PW'=>'passer1'
     ]);
    
        $crawler = $client->request('POST', '/api/depot',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{
            "compte_id":6,
            "caissier_id":3,
            "montant":75000
        }'
    );
        $rep = $client->getResponse();
         var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
    }

}