<?php

namespace Boutique\ProduitsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/shop", name="shopview")
     */
    public function shopAction()
    {
        return $this->render('@BoutiqueFront/Default/shop.html.twig');
    }
}
