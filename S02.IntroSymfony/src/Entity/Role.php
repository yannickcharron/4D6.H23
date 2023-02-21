<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ORM\Table(name:'roles')]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:'idRole')]
    private ?int $idRole = null;

    #[ORM\Column(length: 10)]
    private ?string $name = null;

    #[ORM\Column(name:'sortOrder')]
    private ?int $sortOrder = null;

    #[ORM\OneToMany(targetEntity:Champion::class, mappedBy:"mainRole", fetch:"LAZY")]
    private $champions;

    public function getIdRole(): ?int
    {
        return $this->idRole;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSortOrder(): ?int
    {
        return $this->sortOrder;
    }

    public function setSortOrder(int $sortOrder): self
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    public function getChampions() : Collection {
        return $this->champions;
    }
}
