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
}
