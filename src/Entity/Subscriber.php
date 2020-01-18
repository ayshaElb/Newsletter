<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubscriberRepository")
 * 
 */
class Subscriber
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=180)
     * @Assert\Email(  
     * message = "L'email '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\TypeNewsletter", inversedBy="subscribers")
     * @ORM\JoinTable
     * 
     */
    private $types;


    public function __construct()
    {
        
        $this->createdAt = new \DateTime();
        $this->types = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->types;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|TypeNewsletter[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(TypeNewsletter $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->addSubscriber($this);
        }

        return $this;
    }

    public function removeType(TypeNewsletter $type): self
    {
        if ($this->types->contains($type)) {
            $this->types->removeElement($type);
            $type->removeSubscriber($this);
        }

        return $this;
    }

    
}
