<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\fr_FR\Address;
use Faker\Provider\fr_FR\Text;

class MatiereFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i=0; $i<8; $i++) {
            $matiere = new Matiere();
            $matiere->setIntitule(Address::randomLetter());
            $matiere->setCoefficient(Address::randomFloat(2, 1, 5));
            $manager->persist($matiere);
        }
        $manager->flush($matiere);
    }
}
