<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\CorrespondanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get", "delete"},
 *      normalizationContext={"groups"={"correspondace:read"}},
 *      denormalizationContext={"groups"={"correspondace:write"}}
 * )
 * @ORM\Entity(repositoryClass=CorrespondanceRepository::class)
 */

#[ApiResource(mercure: true)]
class Correspondance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups("correspondance:read")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * 
     * @Groups({"correspondace:read"})
     * 
     */
    private $date;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"correspondace:read", "correspondace:write"})
     * 
     */
    private $idEtudiantCible;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * 
     * @Groups({"correspondace:read", "correspondace:write"})
     * 
     */
    private $idEntrepriseCible;

    /**
     * @ORM\Column(type="boolean")
     * 
     * @Groups({"correspondace:read", "correspondace:write"})
     * 
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Candidature", inversedBy="correspondances", cascade={"persist"})
     */
    private $candidature;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Annonce", inversedBy="correspondances", cascade={"persist"})
     * 
     * @Groups({"correspondace:read", "correspondace:write"})
     * 
     */
    private $annonce;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="correspondance", cascade={"persist"})
     * 
     * @Groups({"correspondace:read", "correspondace:write"})
     * 
     */
    private $messages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdEtudiantCible(): ?int
    {
        return $this->idEtudiantCible;
    }

    public function setIdEtudiantCible(?int $idEtudiantCible): self
    {
        $this->idEtudiantCible = $idEtudiantCible;

        return $this;
    }

    public function getIdEntrepriseCible(): ?int
    {
        return $this->idEntrepriseCible;
    }

    public function setIdEntrepriseCible(?int $idEntrepriseCible): self
    {
        $this->idEntrepriseCible = $idEntrepriseCible;

        return $this;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getCandidature(): ?candidature
    {
        return $this->candidature;
    }

    public function setCandidature(?candidature $candidature): self
    {
        $this->candidature = $candidature;

        return $this;
    }

    public function getAnnonce(): ?annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(?annonce $annonce): self
    {
        $this->annonce = $annonce;

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
            $message->setCorrespondance($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getCorrespondance() === $this) {
                $message->setCorrespondance(null);
            }
        }

        return $this;
    }
}
