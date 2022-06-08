<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get", "delete", "patch"},
 *      normalizationContext={"groups"={"etudiant:read"}},
 *      denormalizationContext={"groups"={"etudiant:write"}}
 * )
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */

#[ApiResource(mercure: true)]
class Etudiant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"etudiant:read"})
     * 
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="etudiant", cascade={"persist", "remove"})
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $photo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $niveauEtude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $typeRecherche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $zoneRecherche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $cv;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse")
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Candidature", mappedBy="etudiant", cascade={"persist"})
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $candidatures;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Annonce", mappedBy="etudiant", cascade={"persist"})
     */
    private $annonces;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="etudiant", cascade={"persist"})
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="etudiant", cascade={"persist"})
     * @Groups({"etudiant:read", "etudiant:write"})
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"etudiant:read", "etudiant:write"})
     * 
     */
    private $description;

    public function __construct()
    {
        $this->candidatures = new ArrayCollection();
        $this->annonces = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?user
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?user $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?string
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(?string $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getNiveauEtude(): ?string
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(?string $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    public function getTypeRecherche(): ?string
    {
        return $this->typeRecherche;
    }

    public function setTypeRecherche(?string $typeRecherche): self
    {
        $this->typeRecherche = $typeRecherche;

        return $this;
    }

    public function getZoneRecherche(): ?string
    {
        return $this->zoneRecherche;
    }

    public function setZoneRecherche(?string $zoneRecherche): self
    {
        $this->zoneRecherche = $zoneRecherche;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(?string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function getAdresse(): ?adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Candidature>
     */
    public function getCandidatures(): Collection
    {
        return $this->candidatures;
    }

    public function addCandidature(Candidature $candidature): self
    {
        if (!$this->candidatures->contains($candidature)) {
            $this->candidatures[] = $candidature;
            $candidature->setEtudiant($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->removeElement($candidature)) {
            // set the owning side to null (unless already changed)
            if ($candidature->getEtudiant() === $this) {
                $candidature->setEtudiant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->addEtudiant($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            $annonce->removeEtudiant($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setEtudiant($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEtudiant() === $this) {
                $message->setEtudiant(null);
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
            $tag->addEtudiant($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeEtudiant($this);
        }

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
}
