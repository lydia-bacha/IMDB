<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {


        //creer un admin
        $admin= new User();
        $password = $this->encoder->encodePassword($admin, "mdp");
        $admin->setUsername("toto")
            ->setRoles(["ROLE_USER","ROLE_ADMIN"])
            ->setNom("bacha")
            ->setPrenom("lydia")
            ->setPassword($password)
            ;

        $manager->persist($admin);
        $manager->flush();
    }
}
