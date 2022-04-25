<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get"},
 *      normalizationContext={"groups"={"tag:read"}},
 *      denormalizationContext={"groups"={"tag:write"}}
 * )
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"tag:read"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"tag:read", "tag:write"})
     * 
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity=Annonce::class, inversedBy="tags", cascade={"persist"})
     * 
     */
    private $annonce;

    /**
     * @ORM\ManyToMany(targetEntity=Candidature::class, inversedBy="tags", cascade={"persist"})
     * 
     * 
     */
    private $candidature;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Etudiant", inversedBy="tags", cascade={"persist"})
     * 
     */
    private $etudiant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Entreprise", inversedBy="tags", cascade={"persist"})
     * 
     */
    private $entreprise;

    public function __construct()
    {
        $this->annonce = new ArrayCollection();
        $this->candidature = new ArrayCollection();
        $this->etudiant = new ArrayCollection();
        $this->entreprise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, annonce>
     */
    public function getAnnonce(): Collection
    {
        return $this->annonce;
    }

    public function addAnnonce(annonce $annonce): self
    {
        if (!$this->annonce->contains($annonce)) {
            $this->annonce[] = $annonce;
        }

        return $this;
    }

    public function removeAnnonce(annonce $annonce): self
    {
        $this->annonce->removeElement($annonce);

        return $this;
    }

    /**
     * @return Collection<int, candidature>
     */
    public function getCandidature(): Collection
    {
        return $this->candidature;
    }

    public function addCandidature(candidature $candidature): self
    {
        if (!$this->candidature->contains($candidature)) {
            $this->candidature[] = $candidature;
        }

        return $this;
    }

    public function removeCandidature(candidature $candidature): self
    {
        $this->candidature->removeElement($candidature);

        return $this;
    }

    /**
     * @return Collection<int, etudiant>
     */
    public function getEtudiant(): Collection
    {
        return $this->etudiant;
    }

    public function addEtudiant(etudiant $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant[] = $etudiant;
        }

        return $this;
    }

    public function removeEtudiant(etudiant $etudiant): self
    {
        $this->etudiant->removeElement($etudiant);

        return $this;
    }

    /**
     * @return Collection<int, entreprise>
     */
    public function getEntreprise(): Collection
    {
        return $this->entreprise;
    }

    public function addEntreprise(entreprise $entreprise): self
    {
        if (!$this->entreprise->contains($entreprise)) {
            $this->entreprise[] = $entreprise;
        }

        return $this;
    }

    public function removeEntreprise(entreprise $entreprise): self
    {
        $this->entreprise->removeElement($entreprise);

        return $this;
    }
}
