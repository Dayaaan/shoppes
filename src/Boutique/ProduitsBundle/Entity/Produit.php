<?php

namespace Boutique\ProduitsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Boutique\ProduitsBundle\Entity\Image;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity(repositoryClass="Boutique\ProduitsBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 15,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="nomProduit", type="string", length=255, nullable=true)
     */
    private $nomProduit;

    /**
     * @var float
     * 
     * @ORM\Column(name="prix", type="float", nullable=true)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer", nullable=true)
     */
    private $quantite;


    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="produit", cascade={"remove"})
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="Categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\OneToOne(targetEntity="ImagePrincipale", cascade={"persist","remove"})
     */
    private $imagePrincipale;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomProduit
     *
     * @param string $nomProduit
     *
     * @return Produit
     */
    public function setNomProduit($nomProduit)
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    /**
     * Get nomProduit
     *
     * @return string
     */
    public function getNomProduit()
    {
        return $this->nomProduit;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Produit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \Boutique\ProduitsBundle\Entity\Image $image
     *
     * @return Produit
     */
    public function addImage(\Boutique\ProduitsBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Boutique\ProduitsBundle\Entity\Image $image
     */
    public function removeImage(\Boutique\ProduitsBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add category
     *
     * @param \Boutique\ProduitsBundle\Entity\Categorie $category
     *
     * @return Produit
     */
    public function addCategory(\Boutique\ProduitsBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Boutique\ProduitsBundle\Entity\Categorie $category
     */
    public function removeCategory(\Boutique\ProduitsBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set ImagePrincipale
     *
     * @param \Boutique\ProduitsBundle\Entity\ImagePrincipale $imagePrincipale
     *
     * @return Produit
     */
    public function setImagePrincipale(\Boutique\ProduitsBundle\Entity\ImagePrincipale $imagePrincipale = null)
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    /**
     * Get ImagePrincipale
     *
     * @return \Boutique\ProduitsBundle\Entity\ImagePrincipale
     */
    public function getImagePrincipale()
    {
        return $this->imagePrincipale;
    }
}
