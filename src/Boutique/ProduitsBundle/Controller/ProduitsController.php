<?php
namespace Boutique\ProduitsBundle\Controller;
use Boutique\ProduitsBundle\Entity\Image;
use Boutique\ProduitsBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class ProduitsController extends Controller
{
    /**
     * @Route("/shop", name="shopview")
     */
    public function shopAction()
    {
        return $this->render('produits/produits.html.twig');
    }
    /**
     * @Route("/addProduct", name="addProduct")
     */
    public function addProductAction()
    {
        
        $product = new Produit();
        $product->setNomProduit("chaussures")
                ->setPrix(45)
                ->setDescription("chaussure de ouf")
                ->setQuantite(10);
        $product2 = new Produit();
        $product2->setNomProduit("vestes")
                 ->setPrix(450)
                 ->setDescription("vestes de ouf")
                 ->setQuantite(100);
        $em = $this->getDoctrine()
                   ->getManager();
       
        $em->flush();
        $image = new Image();
        $image->setPath("https://via.placeholder.it/350x150")
              ->setAlt("yoyo");
        $image2 = new Image();
        $image2->setPath("https://via.placeholder.it/350x150")
               ->setAlt("hehe");
        $ee = $this->getDoctrine()
                   ->getManager();
        $product->addImage($image);
        $product2->addImage($image2);
        $em->persist($product);
        $em->persist($product2);
        $image->setProduit($product);
        $image2->setProduit($product2);
        $ee->persist($image);
        $ee->persist($image2);
         
        
        $ee->flush();
                   
       return new Response("Produit et image ajouté !");
    }
    /**
     * @Route("/updateProduct/{id}", name="updateProduct")
     */
    public function updateProduct(Produit $produit, $id) {
        $produit->setNomProduit("vestes")
                ->setPrix(450)
                ->setDescription("vestes de ouf")
                ->setCheminPhoto("https://via.placeholder.com/150")
                ->setQuantite(10);
        $em = $this->getDoctrine()
                   ->getManager();
        
        $em->persist($produit);
        $em->flush();
        return new Response("Produit modifié : $id");
    }
    /**
     *  @Route("/delProduct/{id}", name="delProduct")
     */
    public function deleteAction(Produit $produit, $id) {
        $em = $this->getDoctrine()
                   ->getManager();
                   
        $em->remove($produit);
        $em->flush();
        return new Response("Produit suprimé :  $id");
    }
}