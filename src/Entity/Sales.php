<?php

namespace App\Entity;

use App\Repository\SalesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalesRepository::class)]
class Sales
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $company_id = null;

    #[ORM\Column]
    private ?float $amount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyId(): ?int
    {
        return $this->company_id;
    }

    public function setCompanyId(int $company_id): static
    {
        $this->company_id = $company_id;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }


    public function getSale(): ?Company
    {
        return $this->sale;
    }

    public function setSale(?Company $sale): static
    {
        $this->sale = $sale;

        return $this;
    }

}
