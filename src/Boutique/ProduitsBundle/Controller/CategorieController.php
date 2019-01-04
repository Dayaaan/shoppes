<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategorieController extends Controller
{
    /**
     * @Route("/addCategorie", name="addCategorie")
     */

    public function addCategorieAction()
    {
        $category = new Categorie();
        $category->setNom('Fashion')
                 ->setDescription("style fashion de ouf");
        
        $em = $this->getDoctrine()
                   ->getManager();
        $em->persist($category);
        $em->flush(); 

        return New Response("Catégorie ajouté");
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
