<?php

namespace App\Entity;

use App\Repository\ItemInventoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemInventoryRepository::class)]
#[ORM\Table(name:'items_inventories')]
class ItemInventory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'idItemInventory')]
    private ?int $idItemInventory = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name:'idItem', referencedColumnName:'idItem', nullable: false)]
    private ?Item $item = null;
    
    #[ORM\ManyToOne(inversedBy: 'inventories')]
    #[ORM\JoinColumn(name:'idProfile', referencedColumnName:'idProfile', nullable: false)]
    private ?User $user = null;

    public function getIdItemInventory(): ?int
    {
        return $this->idItemInventory;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
