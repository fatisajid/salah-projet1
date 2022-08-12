<?php

namespace App\DataFixtures;

use App\Entity\Employes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmployesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 1; $i <= 10; $i++)
        {
            $employes = new Employes;

            $employes->setNom("Nom $i")
                     ->setPrenom("Prenom")
                     ->setTelephone("0601020304")
                     ->setEmail("fatima@gmail.com")
                     ->setAdresse("18 avenue jean moulin")
                     ->setSalaire("2000")
                     ->setDatedenaissance(new \DateTime())
                     ->setPoste("developpeuse");

                     $manager->persist($employes);



    
        }

        $manager->flush();
    }
}
