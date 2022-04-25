<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get", "delete", "patch"},
 *      normalizationContext={"groups"={"entreprise:read"}},
 *      denormalizationContext={"groups"={"entreprise:write"}}
 * )
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("entreprise:read")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Utilisateur", inversedBy="entreprise", cascade={"persist", "remove"})
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $utilisateur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $photo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $interlocuteur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", cascade={"persist"})
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Candidature", mappedBy="entreprise", cascade={"persist"})
     * 
     * @Groups({"entreprise:read"})
     * 
     */
    private $candidatures;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Annonce", mappedBy="entreprise", cascade={"persist"})
     * 
     * @Groups({"entreprise:read"})
     * 
     */
    private $annonces;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="entreprise", cascade={"persist"})
     * 
     * @Groups({"entreprise:read"})
     * 
     */
    private $messages;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="entreprise", cascade={"persist"})
     * 
     * @Groups({"entreprise:read", "entreprise:write"})
     * 
     */
    private $tags;

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

    public function getUtilisateur(): ?utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getSiren(): ?int
    {
        return $this->siren;
    }

    public function setSiren(?int $siren): self
    {
        $this->siren = $siren;

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

    public function getInterlocuteur(): ?string
    {
        return $this->interlocuteur;
    }

    public function setInterlocuteur(?string $interlocuteur): self
    {
        $this->interlocuteur = $interlocuteur;

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
            $candidature->addEntreprise($this);
        }

        return $this;
    }

    public function removeCandidature(Candidature $candidature): self
    {
        if ($this->candidatures->removeElement($candidature)) {
            $candidature->removeEntreprise($this);
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
            $annonce->addEntreprise($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            $annonce->removeEntreprise($this);
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
            $message->setEntreprise($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEntreprise() === $this) {
                $message->setEntreprise(null);
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
            $tag->addEntreprise($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeEntreprise($this);
        }

        return $this;
    }
}
