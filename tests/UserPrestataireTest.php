<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserPrestataireTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'admin10@gmail.com',
            'PHP_AUTH_PW'=>'passer1'
         ]);
        $crawler = $client->request('POST', '/api/users',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{
            "username":"user1@gmail.com",
            "password":"passer1",
            "entreprise" : 15,
            "nom":"DIOP",
            "prenom" : "Kya",
            "contact":7623932,
            "email": "kya@hotmail.com",
            "adresse" : "Niarry Tally",
             "cni" : 789456123

        }'
    );
        $rep = $client->getResponse();
         var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
}
}
