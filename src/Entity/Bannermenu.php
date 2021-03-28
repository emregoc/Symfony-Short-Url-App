<?php

namespace App\Entity;

use App\Repository\BannermenuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BannermenuRepository::class)
 */
class Bannermenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $urlname;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $aktif;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrlname(): ?string
    {
        return $this->urlname;
    }

    public function setUrlname(?string $urlname): self
    {
        $this->urlname = $urlname;

        return $this;
    }

    public function getAktif(): ?bool
    {
        return $this->aktif;
    }

    public function setAktif(?bool $aktif): self
    {
        $this->aktif = $aktif;

        return $this;
    }
}
