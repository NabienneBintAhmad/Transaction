<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SuperAdminFixetures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
       
        $user = new User();
        $user->setUsername("nabienne@gmail.com");
        $password= $this->encoder->encodePassword($user, 'passer1');
        $user->setPassword($password);
        $user->setRoles(["ROLE_SUPERADMIN"]);
        $user->setStatut("Toujours active");
        $user->setImageName("rthbhnbnj.jpg");
        $user->setUpdatedAt(new \DateTime);
        $manager->persist($user);
        $manager->flush();
    }
}
