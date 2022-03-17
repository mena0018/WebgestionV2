<?php

namespace App\DataFixtures;

use App\Entity\Note;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Provider\fr_FR\Address;

class NoteFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i<10; $i++) {
            $note = new Note();
            $note->setCoefficient(Address::numberBetween(1,5));
            $note->setValeur(Address::numberBetween(0,20));
            $manager->persist($note);
        }
        $manager->flush($note);
    }
}
