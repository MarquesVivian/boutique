<?php

namespace App\Controller;

use App\Entity\Contenir;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Form\PanierType;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panier")
 */
class PanierController extends AbstractController
{
    /**
     * @Route("/", name="panier_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $manager): Response
    {
        $lePanier = $manager->getRepository(Panier::class)->findAll();

        if (count($lePanier)==0) {
            $lePanier = new Panier();
            $dateCreation = "2020/11/01";

            $lePanier->setDateCreation(new \DateTime($dateCreation));
            $lePanier->getMontantTotal(0);
            $manager->persist($lePanier);
            $manager->flush();
        }else{
            $lePanier=$lePanier[0];
            $dateCreation = $lePanier->getDateCreation();
            $montant_total = $lePanier->getMontantTotal();

            $lesProduits =$manager->getRepository(Contenir::class)->findAll();
            return $this->render('panier/index.html.twig',[
                'controller_name' =>'PanierController',
                'paniers' => $lePanier,
                'date_creation' =>$dateCreation,
                'montant_total' => $montant_total,
                'les_produits' => $lesProduits
            ]);

        }

        return $this->render('panier/index.html.twig', [
            'paniers' => $manager->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="panier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $panier = new Panier();
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($panier);
            $entityManager->flush();

            return $this->redirectToRoute('panier_index');
        }

        return $this->render('panier/new.html.twig', [
            'panier' => $panier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panier_show", methods={"GET"})
     */
    public function show(Panier $panier): Response
    {
        return $this->render('panier/show.html.twig', [
            'panier' => $panier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="panier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Panier $panier): Response
    {
        $form = $this->createForm(PanierType::class, $panier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('panier_index');
        }

        return $this->render('panier/edit.html.twig', [
            'panier' => $panier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="panier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Panier $panier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$panier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($panier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('panier_index');
    }


    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add(ProduitRepository $produitRepository ,SessionInterface $session): Response
    {

        return $this->redirectToRoute('produit_index');
    }
}
