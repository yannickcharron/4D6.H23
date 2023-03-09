<?php

namespace App\Entity;

use App\Repository\ComputerCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComputerCategoryRepository::class)]
#[ORM\Table(name: 'computers_categories')]
class ComputerCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column('idComputerCategory')]
    private ?int $idComputerCategory = null;

    #[ORM\Column(name:'categoryName', length: 50)]
    private ?string $categoryName = null;


    public function getIdComputerCategory(): ?int
    {
        return $this->idComputerCategory;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }


}
