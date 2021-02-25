<?php

namespace App\DataFixtures;

use App\Entity\Lodging;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
Use Faker;

class LodgingFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 20; $i++) {
            $lodging = new Lodging();

            if($i===1){
                $lodging->setName('test');
            }
            else {
                $lodging->setName($faker->realText(15));
            }

            $lodging->setLodgingType($this->getReference('type_' . $faker->numberBetween(1, 5)));
            $lodging->setNightPrice($faker->numberBetween(45, 120));
            $lodging->setSpace($faker->numberBetween(10, 30));
            $lodging->setInternetAvailable($faker->numberBetween(0, 1));
            $lodging->setCurrentCondition($faker->realText(25));
            $lodging->setCapacity($faker->numberBetween(1, 8));
            $lodging->setDescription($faker->realText(300));

            $lodging->setPicture("https://manager.groupe-bdl.com/web_content/modeles/114-modele-maison-individuelle-a-etage-1.jpg");

            $manager->persist($lodging);

            $this->addReference('lodging_'.$i, $lodging);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            LodgingTypeFixtures::class
        ];
    }
}