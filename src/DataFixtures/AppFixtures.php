<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Correspondre;
use App\Entity\Produit;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use ProxyManager\Example\GhostObjectSkippedProperties\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categoriRonde = new Categorie();
        $categoriRonde ->setLibelle("Rondes");
        $manager->persist($categoriRonde);

        $categoriTriangle = new Categorie();
        $categoriTriangle ->setLibelle("Triangulaires");
        $manager->persist($categoriTriangle);

        $categoriCarree = new Categorie();
        $categoriCarree ->setLibelle("Carrées");
        $manager->persist($categoriCarree);

        $manager->flush();

        $produitRougeCarre = new Produit();
        $produitRougeCarre->setLibelle("gommete Rouge carrées");
        $produitRougeCarre->setTarif(20);
        $produitRougeCarre->setIdCategorie($categoriCarree);
        $manager->persist($produitRougeCarre);

        $produitVertCarre = new Produit();
        $produitVertCarre->setLibelle("gommette Verte carrées");
        $produitVertCarre->setTarif(22);
        $produitVertCarre->setIdCategorie($categoriCarree);
        $manager->persist($produitVertCarre);

        $produitBleuCarre = new Produit();
        $produitBleuCarre->setLibelle("gommette bleu carrées");
        $produitBleuCarre->setTarif(43);
        $produitBleuCarre->setIdCategorie($categoriCarree);
        $manager->persist($produitBleuCarre);

        $produitBleuRond = new Produit();
        $produitBleuRond->setLibelle("gommette bleu ronde");
        $produitBleuRond->setTarif(26);
        $produitBleuRond->setIdCategorie($categoriRonde);
        $manager->persist($produitBleuRond);

        $produitBleuTriangle = new Produit();
        $produitBleuTriangle->setLibelle("gomme bleu triangulaire");
        $produitBleuTriangle->setTarif(85);
        $produitBleuTriangle->setIdCategorie($categoriTriangle);
        $manager->persist($produitBleuTriangle);

        $manager->flush();

        $tagGommette = new Tag();
        $tagGommette->setNom("gommette");
        $manager->persist($tagGommette);

        $tagRouge = new Tag();
        $tagRouge->setNom("rouge");
        $manager->persist($tagRouge);

        $tagVert = new Tag();
        $tagVert->setNom("Vert");
        $manager->persist($tagVert);

        $tagBleu = new Tag();
        $tagBleu->setNom("Bleu");
        $manager->persist($tagBleu);

        $tagNoir = new Tag();
        $tagNoir->setNom("Noir");
        $manager->persist($tagNoir);

        $tagRond = new Tag();
        $tagRond->setNom("Rond");
        $manager->persist($tagRond);

        $tagCarree = new Tag();
        $tagCarree->setNom("Carree");
        $manager->persist($tagCarree);

        $tagTriangle = new Tag();
        $tagTriangle->setNom("Triangle");
        $manager->persist($tagTriangle);

        $manager->flush();


        $correspondre1 = new Correspondre();
        $correspondre1->setIdProduit($produitBleuTriangle);
        $correspondre1->setIdTag($tagGommette);
        $manager->persist($correspondre1);

        $manager->flush();

    }
}
