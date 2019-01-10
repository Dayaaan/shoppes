<?php
namespace Boutique\ProduitsBundle\Controller;
use Boutique\ProduitsBundle\Entity\Image;
use Boutique\ProduitsBundle\Entity\Produit;
use Boutique\ProduitsBundle\Entity\Categorie;
use Boutique\ProduitsBundle\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Boutique\ProduitsBundle\Entity\ImagePrincipale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProduitsController extends Controller
{
    /**
     * @Route("/shop", name="shopview")
     */
    public function shopAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository(Produit::class)->findAll();

        $categories = $em->getRepository(Categorie::class)->findAll();

        dump($products);
        dump($categories);

        return $this->render('produits/produits.html.twig',
            [
                'products' => $products,
                'categories' => $categories
            ]
        );
    }
    /**
     * @Route("/addProduct", name="addProduct")
     */

    public function addProductAction(Request $request)
    {

        $product = new Produit();

        $form = $this->createForm(ProduitType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
    
            return $this->redirectToRoute('shopview');
        }
        
    //     $product = new Produit();            
    //     $product->setNomProduit("chaussures")
    //             ->setPrix(45)
    //             ->setDescription("chaussure de ouf")
    //             ->setQuantite(10);

    //     $imagePrincipale1 = new ImagePrincipale();
    //     $imagePrincipale1->setPath("https://via.placeholder.com/qq70x80")
    //                         ->setAlt("photo");  

    //     $product2 = new Produit();
    //     $product2->setNomProduit("vestes")
    //              ->setPrix(450)
    //              ->setDescription("vestes de ouf")
    //              ->setQuantite(100);

    //     $imagePrincipale2 = new ImagePrincipale();
    //     $imagePrincipale2->setPath("https://via.placeholder.com/qq90x90")
    //                      ->setAlt("photo");   

    //     $em = $this->getDoctrine()
    //                ->getManager();
       


    //     $image = new Image();
    //     $image->setPath("https://via.placeholder.it/350x150")
    //           ->setAlt("yoyo");

    //     $image2 = new Image();
    //     $image2->setPath("https://via.placeholder.it/350x150")
    //            ->setAlt("hehe");

    //     $product->addImage($image);
    //     $product2->addImage($image2);

    //     $product->setImagePrincipale($imagePrincipale1);
    //     $product2->setImagePrincipale($imagePrincipale2);

    //     $em->persist($product);
    //     $em->persist($product2);

    //     $image->setProduit($product);
    //     $image2->setProduit($product2);

    //     $em->persist($image);
    //     $em->persist($image2);

    //     $categories = $em->getRepository(Categorie::class)->findAll();


    //     foreach ($categories as $category) {
    //         $product->addCategory($category);
    //         $product2->addCategory($category);
    //     }

    //     $em->persist($product);
    //     $em->persist($product2);

        
         
    //     $em->flush();
                   
    //    return new Response("Produit et image ajouté !");

        return $this->render("produit/addproduct.html.twig",
            [
                'form' => $form->createView()
            ]);
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

    /** 
     * @Route("/displayProduct/{id}", name="displayProduct")
     */

     public function displayProductById($id) {

        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Produit::class)->find($id);

        dump($product);


        return $this->render("produit/produit.html.twig", 
            ['product' => $product]
        );
     }
}