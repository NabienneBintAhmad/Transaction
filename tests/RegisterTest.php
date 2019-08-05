<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterTest extends WebTestCase
{
    public function testSomething()
    {
        $client = static::createClient([],[
            'PHP_AUTH_USER'=>'nabienne@gmail.com',
            'PHP_AUTH_PW'=>'passer1'
         ]);
        $crawler = $client->request('POST', '/api/register',[],[],
        ['CONTENT_TYPE' => 'application/json'],
        '{
            "username":"admin11@gmail.com",
            "password":"passer1",
            "nom":"NDIAYE",
            "prenom" : "Ndioufa",
            "email": "ndioufahotmail.com",
            "adresse" : "Niarry Tally",
             "contact":7623932,
             "cni" : 789456123,
             "statut" : "Debloquer",
             "nom1":"BADIANE",
            "prenom1" : "Waly",
            "nom_entreprise":"Sunu Service",
            "adresse1" : "Dakar",
             "contact1":7622332,
             "cni1" : 7894563253,
             "email1": "abdou@hotmail.com",
             "statut1" : "debloquer",
             "solde" : 750000

        }'
    );
        $rep = $client->getResponse();
         var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
}
    }

