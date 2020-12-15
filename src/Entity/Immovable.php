<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImmovableRepository")
 */
class Immovable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prestation;

    /**
     * @ORM\ManyToOne(targetEntity="Address", inversedBy="immovable")
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $room;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bedroom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sold = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $energyPerformanceCertificate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $greenhouseGas;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $chargesIncluded;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bathroom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $securityDeposit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fees;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPrestation(): ?string
    {
        return $this->prestation;
    }

    public function setPrestation(string $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): Address
    {
        $this->address = $address;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(?string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getRoom(): ?string
    {
        return $this->room;
    }

    public function setRoom(?string $room): self
    {
        $this->room = $room;

        return $this;
    }

    public function getBedroom(): ?string
    {
        return $this->bedroom;
    }

    public function setBedroom(?string $bedroom): self
    {
        $this->bedroom = $bedroom;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFloor(): ?string
    {
        return $this->floor;
    }

    public function setFloor(?string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getHeat(): ?string
    {
        return $this->heat;
    }

    public function setHeat(string $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getSold(): ?string
    {
        return $this->sold;
    }

    public function setSold(string $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getEnergyPerformanceCertificate(): ?string
    {
        return $this->energyPerformanceCertificate;
    }

    public function setEnergyPerformanceCertificate(string $energyPerformanceCertificate): self
    {
        $this->energyPerformanceCertificate = $energyPerformanceCertificate;

        return $this;
    }

    public function getDateCreation(): ?string
    {
        return $this->dateCreation;
    }

    public function setDateCreation(string $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

   public function getSlug(){
       return (new Slugify())->slugify($this->title);
   }

   public function getGreenhouseGas(): ?string
   {
       return $this->greenhouseGas;
   }

   public function setGreenhouseGas(string $greenhouseGas): self
   {
       $this->greenhouseGas = $greenhouseGas;

       return $this;
   }

   public function getChargesIncluded(): ?bool
   {
       return $this->chargesIncluded;
   }

   public function setChargesIncluded(?bool $chargesIncluded): self
   {
       $this->chargesIncluded = $chargesIncluded;

       return $this;
   }

   public function getBathroom(): ?string
   {
       return $this->bathroom;
   }

   public function setBathroom(string $bathroom): self
   {
       $this->bathroom = $bathroom;

       return $this;
   }

   public function getSecurityDeposit(): ?string
   {
       return $this->securityDeposit;
   }

   public function setSecurityDeposit(?string $securityDeposit): self
   {
       $this->securityDeposit = $securityDeposit;

       return $this;
   }

   public function getFees(): ?string
   {
       return $this->fees;
   }

   public function setFees(string $fees): self
   {
       $this->fees = $fees;

       return $this;
   }

   public function getContact(): ?string
   {
       return $this->contact;
   }

   public function setContact(string $contact): self
   {
       $this->contact = $contact;

       return $this;
   }

   public function getImage(): ?string
   {
       return $this->image;
   }

   public function setImage(?string $image): self
   {
       $this->image = $image;

       return $this;
   }
}
