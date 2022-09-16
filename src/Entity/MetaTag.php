<?php

namespace App\Entity;

use App\Repository\MetaTagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetaTagRepository::class)]
class MetaTag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $charset = null;

    #[ORM\Column(length: 255)]
    private ?string $pageName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $httpEquiv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $itemprop = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCharset(): ?string
    {
        return $this->charset;
    }

    public function setCharset(?string $charset): self
    {
        $this->charset = $charset;

        return $this;
    }

    public function getPageName(): ?string
    {
        return $this->pageName;
    }

    public function setPageName(string $pageName): self
    {
        $this->pageName = $pageName;

        return $this;
    }

    public function getHttpEquiv(): ?string
    {
        return $this->httpEquiv;
    }

    public function setHttpEquiv(?string $httpEquiv): self
    {
        $this->httpEquiv = $httpEquiv;

        return $this;
    }

    public function getItemprop(): ?string
    {
        return $this->itemprop;
    }

    public function setItemprop(?string $itemprop): self
    {
        $this->itemprop = $itemprop;

        return $this;
    }
}
