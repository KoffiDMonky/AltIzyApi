<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get", "delete", "patch"},
 *      normalizationContext={"groups"={"annonce:read"}},
 *      denormalizationContext={"groups"={"annonce:write"}}
 * )
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */

#[ApiResource(mercure: true)]
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"annonce:read"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"annonce:read", "annonce:write"})
     * 
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"annonce:read", "annonce:write"})
     * 
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"annonce:read", "annonce:write"})
     * 
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"annonce:read", "annonce:write"})
     * 
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Etudiant", inversedBy="annonces", cascade={"persist"})
     * 
     * @Groups({"annonce:write"})
     * 
     */
    private $etudiant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Entreprise", inversedBy="annonces", cascade={"persist"})
     * 
     * @Groups({"annonce:write"})
     * 
     */
    private $entreprise;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Correspondance", mappedBy="annonce", cascade={"persist"})
     * 
     * @Groups({"annonce:write"})
     * 
     */
    private $correspondances;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="annonce", cascade={"persist"})
     * 
     * @Groups({"annonce:read", "annonce:write"})
     * 
     */
    private $tags;

    public function __construct()
    {
        $this->etudiant = new ArrayCollection();
        $this->entreprise = new ArrayCollection();
        $this->correspondances = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

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
            $correspondance->setAnnonce($this);
        }

        return $this;
    }

    public function removeCorrespondance(Correspondance $correspondance): self
    {
        if ($this->correspondances->removeElement($correspondance)) {
            // set the owning side to null (unless already changed)
            if ($correspondance->getAnnonce() === $this) {
                $correspondance->setAnnonce(null);
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
            $tag->addAnnonce($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeAnnonce($this);
        }

        return $this;
    }
}
