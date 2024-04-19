<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert; 
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)] 
    #[Assert\Length( 
        min: 2, 
        max: 50, 
        minMessage: 'Le nom du produit doit faire au moins {{ limit }} caractères', 
        maxMessage: 'Le nom du produit ne doit pas dépasser {{ limit }} caractères', 
    )] 
    private ?string $nom = null; 

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?bool $rupture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lienImage = null;

    #[ORM\OneToOne(targetEntity:Reference::class,cascade:["persist"])] 
    private $reference = null;

    #[ORM\ManyToMany(targetEntity:Distributeur::class, cascade:["persist"], inversedBy: 'produits')] 
    private $distributeurs = null; 

    #[ORM\OneToOne(targetEntity:Reference::class,cascade:["persist"], fetch: "EAGER" )]

    public function __construct()
    {
        $this->distributeurs = new ArrayCollection();
    } 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function isRupture(): ?bool
    {
        return $this->rupture;
    }

    public function setRupture(bool $rupture): static
    {
        $this->rupture = $rupture;

        return $this;
    }

    public function getLienImage(): ?string
    {
        return $this->lienImage;
    }

    public function setLienImage(?string $lienImage): static
    {
        $this->lienImage = $lienImage;

        return $this;
    }

    public function getReference(): ?Reference
    {
        return $this->reference;
    }

    public function setReference(?Reference $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return Collection<int, Distributeur>
     */
    public function getDistributeurs(): Collection
    {
        return $this->distributeurs;
    }

    public function addDistributeur(Distributeur $distributeur): static
    {
        if (!$this->distributeurs->contains($distributeur)) { 
 
            $this->distributeurs[] = $distributeur; 
         // prise en compte de la relation inverse :  
            $distributeur->addProduit($this); 
      
     } 

        return $this;
    }

    public function removeDistributeur(Distributeur $distributeur): static
    {
        $this->distributeurs->removeElement($distributeur);

        return $this;
    }
}
