<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\UtilisateurParUid;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={
 *          "get", 
 *          "delete", 
 *          "patch",
 *         },
 *      normalizationContext={"groups"={"utilisateur:read"}},
 *      denormalizationContext={"groups"={"utilisateur:write"}}
 * 
 * )
 * 
 * @ApiFilter(SearchFilter::class, 
 *            properties={"uid" = "exact"})
 * 
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 */

#[ApiResource(mercure: true)]
class Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("utilisateur:read")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"utilisateur:read", "utilisateur:write"})
     * 
     */
    private $login;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Etudiant", mappedBy="utilisateur", cascade={"persist", "remove"})
     * 
     * @Groups({"utilisateur:read"})
     * 
     */
    private $etudiant;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Entreprise", mappedBy="utilisateur", cascade={"persist", "remove"})
     * 
     * @Groups({"utilisateur:read"})
     * 
     */
    private $entreprise;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"utilisateur:read","utilisateur:write"})
     * 
     */
    private $GoogleToken;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"utilisateur:read","utilisateur:write"})
     * 
     */
    private $uid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): self
    {
        // unset the owning side of the relation if necessary
        if ($etudiant === null && $this->etudiant !== null) {
            $this->etudiant->setUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($etudiant !== null && $etudiant->getUtilisateur() !== $this) {
            $etudiant->setUtilisateur($this);
        }

        $this->etudiant = $etudiant;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        // unset the owning side of the relation if necessary
        if ($entreprise === null && $this->entreprise !== null) {
            $this->entreprise->setUtilisateur(null);
        }

        // set the owning side of the relation if necessary
        if ($entreprise !== null && $entreprise->getUtilisateur() !== $this) {
            $entreprise->setUtilisateur($this);
        }

        $this->entreprise = $entreprise;

        return $this;
    }

    public function getGoogleToken(): ?string
    {
        return $this->GoogleToken;
    }

    public function setGoogleToken(string $GoogleToken): self
    {
        $this->GoogleToken = $GoogleToken;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }
}
