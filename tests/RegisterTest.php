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

            "username":"admin1@gmail.com",
            "password":"passer1",
            "imageFile" : ["lena.jpeg"],
            "nom":"DIOP",
            "prenom" : "Kya",
            "email": "kya1@hotmail.com",
            "adresse" : "Niarry Tally",
             "contact":7633932,
             "cni" : 7856356123,
             "nom1":"BADIANE",
            "prenom1" : "Waly",
            "nom_entreprise":"Sunu Service",
            "adresse1" : "Dakar",
             "contact1":7782332,
             "cni1" : 78945633693,
             "email1": "abdou1@hotmail.com",
             "solde" : 750000

        }'
    );
        $rep = $client->getResponse();
         var_dump($rep);
        $this->assertSame(201, $client->getResponse()->getStatusCode());
}
    }

