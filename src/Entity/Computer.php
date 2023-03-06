<?php

namespace App\Entity;

use App\Repository\ComputerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComputerRepository::class)]
#[ORM\Table(name:'computers')]
class Computer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column('idComputer')]
    private ?int $idComputer = null;

    #[ORM\Column(name:'buildName', length: 100)]
    private ?string $buildName = null;

    #[ORM\Column(length: 100)]
    private ?string $motherboard = null;

    #[ORM\Column(length: 100)]
    private ?string $cpu = null;

    #[ORM\Column]
    private ?int $memory = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storage = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $gpu = null;

    #[ORM\Column(length: 2048, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column('isAssembleByUs')]
    private ?bool $isAssembleByUs = null;


    public function getIdComputer(): ?int
    {
        return $this->idComputer;
    }

    public function getBuildName(): ?string
    {
        return $this->buildName;
    }

    // public function setBuildName(string $buildName): self
    // {
    //     $this->buildName = $buildName;

    //     return $this;
    // }

    public function getMotherboard(): ?string
    {
        return $this->motherboard;
    }

    // public function setMotherboard(string $motherboard): self
    // {
    //     $this->motherboard = $motherboard;

    //     return $this;
    // }

    public function getCpu(): ?string
    {
        return $this->cpu;
    }

    // public function setCpu(string $cpu): self
    // {
    //     $this->cpu = $cpu;

    //     return $this;
    // }

    public function getMemory(): ?int
    {
        return $this->memory;
    }

    // public function setMemory(int $memory): self
    // {
    //     $this->memory = $memory;

    //     return $this;
    // }

    public function getStorage(): ?string
    {
        return $this->storage;
    }

    // public function setStorage(?string $storage): self
    // {
    //     $this->storage = $storage;

    //     return $this;
    // }

    public function getGpu(): ?string
    {
        return $this->gpu;
    }

    // public function setGpu(?string $gpu): self
    // {
    //     $this->gpu = $gpu;

    //     return $this;
    // }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    // public function setNotes(?string $notes): self
    // {
    //     $this->notes = $notes;

    //     return $this;
    // }

    public function isIsAssembleByUs(): ?bool
    {
        return $this->isAssembleByUs;
    }

    // public function setIsAssembleByUs(bool $isAssembleByUs): self
    // {
    //     $this->isAssembleByUs = $isAssembleByUs;

    //     return $this;
    // }
}
