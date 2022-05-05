<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Pfe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class Personne extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i =0;$i<20;$i++){
            $pfe =new Pfe();
            $pfe->setTitre("titre ".$i);
            $pfe->setNometudiant($faker->name." ".$faker->firstName);
            $entre = new Entreprise();
            $entre->setDesignation($faker->company);
            $pfe->setEntreprise($entre);
            $manager->persist($entre);



        }
        $manager->flush();

    }
}

