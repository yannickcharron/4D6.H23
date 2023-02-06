<?php

namespace App\Entity;

use App\Repository\ChampionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChampionRepository::class)]
#[ORM\Table(name:'champions')]
class Champion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column('idChampion')]
    private ?int $idChampion = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length:50)]
    private ?string $title = null;

    #[ORM\Column(length:1024)]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity:Role::class, inversedBy:"champions", cascade:["persist"])]
    #[ORM\JoinColumn(name:'idMainRole', referencedColumnName:'idRole')]
    private $mainRole;

    public function getIdChampion(): ?int
    {
        return $this->idChampion;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getMainRole(): ?Role
    {
        return $this->mainRole;
    }
}
