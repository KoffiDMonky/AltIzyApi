<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\AdresseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get", "delete", "patch"},
 *      normalizationContext={"groups"={"adresse:read"}},
 *      denormalizationContext={"groups"={"adresse:write"}}
 * )
 * @ORM\Entity(repositoryClass=AdresseRepository::class)
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("adresse:read")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"adresse:read", "adresse:write"})
     * 
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"adresse:read", "adresse:write"})
     * 
     */
    private $rue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"adresse:read", "adresse:write"})
     * 
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"adresse:read", "adresse:write"})
     * 
     */
    private $ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(?int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
}
