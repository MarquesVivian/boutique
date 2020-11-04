<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categorie();
        $categorie2 = new Categorie();
        $categorie3 = new Categorie();
        $categorie1->setLibelle("Triangle");
        $categorie2->setLibelle("Rond");
        $categorie3->setLibelle("Carre");

        $manager->persist($categorie1);
        $manager->persist($categorie2);
        $manager->persist($categorie3);
        $manager->flush();
    }
}
