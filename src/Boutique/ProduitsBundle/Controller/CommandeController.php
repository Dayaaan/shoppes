<?php

namespace Boutique\ProduitsBundle\Controller;

use Boutique\ProduitsBundle\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CommandeController extends Controller
{
    /**
     * @Route("/order", name="order")
     */

    public function addOrder() {

        $commande = new Commande();
        $commande->setNom("Albert")
                 ->setPrenom("Jacques")
                 ->setAdresse("16 Boulevard Kellerman")
                 ->setVille("Paris")
                 ->setCode("75018");

        $em = $this->getDoctrine()
                   ->getManager();
                   
        $em->persist($commande);
        $em->flush();

        return new Response("Commande ajoutée");
    }
}
