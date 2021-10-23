<?php

namespace App\Entity;

use App\Repository\UserInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserInfoRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class UserInfo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $data;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    private $decodedData;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(?string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @ORM\PostLoad
     */
    public function setDecodedData(): void
    {
        $this->decodedData = json_decode($this->getData(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @ORM\PrePersist
     */
    public function getDecodedData(): void
    {
        $this->data = json_encode($this->decodedData, JSON_THROW_ON_ERROR);
    }

    public function getUserData()
    {
        return $this->decodedData;
    }

    public function getName()
    {
        return $this->decodedData['name'] ?? '';
    }

    public function getLocation()
    {
        return $this->decodedData['location'] ?? '';
    }

    public function getEducation()
    {
        return $this->decodedData['education'] ?? '';
    }

    public function getWork()
    {
        return $this->decodedData['work'] ?? '';
    }

    public function getDescription()
    {
        return $this->decodedData['description'] ?? '';
    }

    public function setName(?string $name): self
    {
        $this->decodedData['name'] = $name;

        return $this;
    }

    public function setLocation(?string $location): self
    {
        $this->decodedData['location'] = $location;

        return $this;
    }

    public function setEducation(?string $education): self
    {
        $this->decodedData['education'] = $education;

        return $this;
    }

    public function setWork(?string $work): self
    {
        $this->decodedData['work'] = $work;

        return $this;
    }

    public function setDescription(?string $desc): self
    {
        $this->decodedData['description'] = $desc;

        return $this;
    }
}
