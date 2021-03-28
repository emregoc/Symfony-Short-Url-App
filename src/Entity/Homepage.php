<?php

namespace App\Entity;

use App\Repository\HomepageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HomepageRepository::class)
 */
class Homepage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $banner;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bannerleft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlundertext;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featureshead;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $featuresparagraf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colomnleftimg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colomnmiddleimg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colomnrightimg;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colomnleftparagraf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colomnmiddleparagraf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colomnrightparagraf;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBanner(): ?string
    {
        return $this->banner;
    }

    public function setBanner(?string $banner): self
    {
        $this->banner = $banner;

        return $this;
    }

    public function getBannerleft(): ?string
    {
        return $this->bannerleft;
    }

    public function setBannerleft(?string $bannerleft): self
    {
        $this->bannerleft = $bannerleft;

        return $this;
    }

    public function getUrlundertext(): ?string
    {
        return $this->urlundertext;
    }

    public function setUrlundertext(?string $urlundertext): self
    {
        $this->urlundertext = $urlundertext;

        return $this;
    }

    public function getFeatureshead(): ?string
    {
        return $this->featureshead;
    }

    public function setFeatureshead(?string $featureshead): self
    {
        $this->featureshead = $featureshead;

        return $this;
    }

    public function getFeaturesparagraf(): ?string
    {
        return $this->featuresparagraf;
    }

    public function setFeaturesparagraf(?string $featuresparagraf): self
    {
        $this->featuresparagraf = $featuresparagraf;

        return $this;
    }

    public function getColomnleftimg(): ?string
    {
        return $this->colomnleftimg;
    }

    public function setColomnleftimg(?string $colomnleftimg): self
    {
        $this->colomnleftimg = $colomnleftimg;

        return $this;
    }

    public function getColomnmiddleimg(): ?string
    {
        return $this->colomnmiddleimg;
    }

    public function setColomnmiddleimg(?string $colomnmiddleimg): self
    {
        $this->colomnmiddleimg = $colomnmiddleimg;

        return $this;
    }

    public function getColomnrightimg(): ?string
    {
        return $this->colomnrightimg;
    }

    public function setColomnrightimg(?string $colomnrightimg): self
    {
        $this->colomnrightimg = $colomnrightimg;

        return $this;
    }

    public function getColomnleftparagraf(): ?string
    {
        return $this->colomnleftparagraf;
    }

    public function setColomnleftparagraf(?string $colomnleftparagraf): self
    {
        $this->colomnleftparagraf = $colomnleftparagraf;

        return $this;
    }

    public function getColomnmiddleparagraf(): ?string
    {
        return $this->colomnmiddleparagraf;
    }

    public function setColomnmiddleparagraf(?string $colomnmiddleparagraf): self
    {
        $this->colomnmiddleparagraf = $colomnmiddleparagraf;

        return $this;
    }

    public function getColomnrightparagraf(): ?string
    {
        return $this->colomnrightparagraf;
    }

    public function setColomnrightparagraf(?string $colomnrightparagraf): self
    {
        $this->colomnrightparagraf = $colomnrightparagraf;

        return $this;
    }
}
