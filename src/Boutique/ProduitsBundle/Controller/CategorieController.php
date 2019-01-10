<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boutique\ProduitsBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategorieController extends Controller
{
    /**
     * @Route("/addCategorie", name="addCategorie")
     */

    public function addCategorieAction(Request $request)
    {
        $category = new Categorie();

        $form = $this->createForm(CategorieType::class, $category);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();
    
            return New Response("Categorie ajouté");
        }

        return $this->render("categorie/addcategorie.html.twig",
            [
                'form' => $form->createView()
            ]);
        
        // $category = new Categorie();
        // $category->setNom('Homme')
        //          ->setDescription("Categorie pour homme");
        
        // $em = $this->getDoctrine()
        //            ->getManager();
        // $em->persist($category);
        // $em->flush(); 

        // return New Response("Catégorie ajouté");
    }

    /**
     * @Route("/delCategorie/{id}", name="delCategorie")
     */

    public function deleteAction(Categorie $categorie) {

        $entityManager = $this->getDoctrine()
                              ->getManager();

        $entityManager->remove($categorie);
        $entityManager->flush();

        return New Response("Catégorie Suprimmé");
    }

    /**
     * @Route("/updateCategorie/{id}", name="updateCategorie")
     */

    public function updateAction(Categorie $categorie) {

        $entityManager = $this->getDoctrine()
                              ->getManager();
        
        $categorie->setNom("Homme")
                  ->setDescription('Homme');
         
        $entityManager->persist($categorie);
        $entityManager->flush();          
         
        return New Response("Catégorie Modifié");


    }
    
}
