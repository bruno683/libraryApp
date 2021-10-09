<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager )
    {

        $employee = new User();
        $employee->setLastName('Richard')
                ->setFirstName('Bruno')
                ->setEmail('b.richard@test.com')
                ->setRoles(['ROLE_EMPLOYEE'])
                ->setPassword($this->passwordHasher->hashPassword(
                    $employee,
                    'Admin72'
                ));
        
        $manager->persist($employee);

        $manager->flush();
    }
}
