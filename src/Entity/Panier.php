<?php
//https://sharemycode.fr/zud
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Panier
{
    private $lignesPanier;

    public function __construct(){
        $this->lignesPanier = new ArrayCollection();
    }
    public function getLignesPanier(): ?Collection
    {
        return $this->lignesPanier;
    }

    public function setLignesPanier(?Collection $lignePaniers): self
    {
        $this->lignesPanier = $lignePaniers;

        return $this;
    }

    public function addLignePanier(LignePanier $lignePanier): self
    {
        //vérifier si produit deja présent dans panier
        foreach ($this->lignesPanier as $ligne) {
            if($ligne->getProduit()->getId() == $lignePanier->getProduit()->getId())
            {
                //si, oui
                    // on modifier lignepanier en ajoutant la nouvelle quantité 
                
                $qte = $lignePanier->getQuantite()+$ligne->getQuantite();
                $ligne->setQuantite($qte); 
                return $this;
            }
        }
        //si, non
                    // on l'ajoute dans panier
        $this->lignesPanier[] = $lignePanier;
        return $this;
    }
    public function updateLignePanier($idProduit, $quantite): self
    {
        foreach ($this->lignesPanier as $ligne) {
            if($ligne->getProduit()->getId() == $idProduit)
            {
                $ligne->setQuantite($quantite); 
                return $this;
            }
        }
        return $this;
    }

    public function removeLignePanier($idProduit): self
    {
        $this->lignesPanier = $this->lignesPanier->filter(function($ligne) use ($idProduit){
            return $ligne->getProduit()->getId() != $idProduit;
        });

        return $this;
    }
}
