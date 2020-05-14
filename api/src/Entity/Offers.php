<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *  
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OffersRepository")
 */
class Offers
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $offer_description;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractsTypes", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $contract_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $work_location;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="offers")
     */
    public $user;

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

    public function getCompanyDescription(): ?string
    {
        return $this->company_description;
    }

    public function setCompanyDescription(string $company_description): self
    {
        $this->company_description = $company_description;

        return $this;
    }

    public function getOfferDescription(): ?string
    {
        return $this->offer_description;
    }

    public function setOfferDescription(string $offer_description): self
    {
        $this->offer_description = $offer_description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getContractType(): ?ContractsTypes
    {
        return $this->contract_type;
    }

    public function setContractType(?ContractsTypes $contract_type): self
    {
        $this->contract_type = $contract_type;

        return $this;
    }

    public function getWorkLocation(): ?string
    {
        return $this->work_location;
    }

    public function setWorkLocation(string $work_location): self
    {
        $this->work_location = $work_location;

        return $this;
    }
}
