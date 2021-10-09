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

    /**
     * Créé un employé
     *
     * @param ObjectManager $manager
     * @return void
     */
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
                ))
                ->setPostalAdress('14 Rue de la bouquinerie 71570 Guinchay La Chapelle-Curreaux ')
                ->setDateOfBirth(new \DateTime('10/01/1972'));
        
        $manager->persist($employee);

        $manager->flush();
    }
}
