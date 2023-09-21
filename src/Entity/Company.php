<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use App\Entity\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $company_name = null;

    #[ORM\OneToMany(mappedBy: 'sale', targetEntity: Sales::class)]
    private \Doctrine\Common\Collections\Collection $sales;

    public function __construct()
    {
        $this->sales = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->company_name;
    }

    public function setCompanyName(string $company_name): static
    {
        $this->company_name = $company_name;

        return $this;
    }

    /**
     * @return Collection|Sale[]
     */
    // public function getSales(): Collection
    // {
    //     return $this->sales;
    // }

    /**
     * @return \Doctrine\Common\Collections\Collection<int, Sales>
     */
    public function getSales(): \Doctrine\Common\Collections\Collection
    {
        return $this->sales;
    }

    public function addSale(Sales $sale): static
    {
        if (!$this->sales->contains($sale)) {
            $this->sales->add($sale);
            $sale->setSale($this);
        }

        return $this;
    }

    public function removeSale(Sales $sale): static
    {
        if ($this->sales->removeElement($sale)) {
            // set the owning side to null (unless already changed)
            if ($sale->getSale() === $this) {
                $sale->setSale(null);
            }
        }

        return $this;
    }
}
