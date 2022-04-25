<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CandidatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get", "delete", "patch"},
 *      normalizationContext={"groups"={"candidature:read"}},
 *      denormalizationContext={"groups"={"candidature:write"}}
 * )
 * @ORM\Entity(repositoryClass=CandidatureRepository::class)
 */
class Candidature
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"candidature:read"})
     * 
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etudiant", inversedBy="candidatures", cascade={"persist"})
     * 
     * @Groups({"candidature:read", "candidature:write"})
     * 
     */
    private $etudiant;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"candidature:read", "candidature:write"})
     * 
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"candidature:read", "candidature:write"})
     * 
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"candidature:read", "candidature:write"})
     * 
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Entreprise", inversedBy="candidatures", cascade={"persist"})
     * 
     * @Groups({"candidature:read", "candidature:write"})
     * 
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Correspondance", mappedBy="candidature", cascade={"persist"})
     */
    private $correspondances;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="candidature", cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->entreprise = new ArrayCollection();
        $this->correspondances = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtudiant(): ?etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?etudiant $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(?string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection<int, Correspondance>
     */
    public function getCorrespondances(): Collection
    {
        return $this->correspondances;
    }

    public function addCorrespondance(Correspondance $correspondance): self
    {
        if (!$this->correspondances->contains($correspondance)) {
            $this->correspondances[] = $correspondance;
            $correspondance->setCandidature($this);
        }

        return $this;
    }

    public function removeCorrespondance(Correspondance $correspondance): self
    {
        if ($this->correspondances->removeElement($correspondance)) {
            // set the owning side to null (unless already changed)
            if ($correspondance->getCandidature() === $this) {
                $correspondance->setCandidature(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addCandidature($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeCandidature($this);
        }

        return $this;
    }
}
