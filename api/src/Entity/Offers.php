<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"offers"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\OffersRepository")
 */
class Offers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"offers"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"offers"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"offers"})
     */
    private $companyDescription;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"offers"})
     */
    private $offerDescription;

    /**
     * @ORM\Column(type="date")
     * @Groups({"offers"})
     */
    private $startDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ContractsTypes", inversedBy="offers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"offers"})
     */
    private $contractType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"offers"})
     */
    private $workLocation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="offer_id")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @Groups({"offers"})
     */
    public $user_id;

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
        return $this->companyDescription;
    }

    public function setCompanyDescription(string $company_description): self
    {
        $this->companyDescription = $company_description;

        return $this;
    }

    public function getOfferDescription(): ?string
    {
        return $this->offerDescription;
    }

    public function setOfferDescription(string $offer_description): self
    {
        $this->offerDescription = $offer_description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->startDate = $start_date;

        return $this;
    }

    public function getContractType(): ?ContractsTypes
    {
        return $this->contractType;
    }

    public function setContractType(?ContractsTypes $contract_type): self
    {
        $this->contractType = $contract_type;

        return $this;
    }

    public function getWorkLocation(): ?string
    {
        return $this->workLocation;
    }

    public function setWorkLocation(string $work_location): self
    {
        $this->workLocation = $work_location;

        return $this;
    }
}
