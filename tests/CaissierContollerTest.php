<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CaissierContollerTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'nabienne@gmail.com',
            'PHP_AUTH_PW'=>'passer1'
         ]);
        $crawler = $client->request('POST', '/api/caissier',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{
            "username":"caissier6@gmail.com",
            "password":"passer1",
            "nom":"NDIAYE",
            "prenom" : "Ndioufa",
            "adresse" : "Niarry Tally",
            "email": "ndioufa@hotmail.com",
             "contact":7622932,
             "cni" : 789456123,
             "statut" : "Debloquer"
            

        }'
    );
        $rep = $client->getResponse();
         var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
}
    
}
