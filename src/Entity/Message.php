<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      itemOperations={"get", "delete"},
 *      normalizationContext={"groups"={"message:read"}},
 *      denormalizationContext={"groups"={"message:write"}}
 * )
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */

#[ApiResource(mercure: true)]
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"message:read"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * 
     * @Groups({"message:read", "message:write"})
     * 
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"message:read", "message:write"})
     * 
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"message:read", "message:write"})
     * 
     */
    private $expediteur;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"message:read", "message:write"})
     * 
     */
    private $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity=Correspondance::class, inversedBy="messages", cascade={"persist"})
     * 
     * @Groups({"message:read", "message:write"})
     * 
     */
    private $correspondance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etudiant", inversedBy="messages", cascade={"persist"})
     * 
     * @Groups({"message:read", "message:write"})
     * 
     */
    private $etudiant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="messages", cascade={"persist"})
     * 
     * @Groups({"message:read", "message:write"})
     * 
     */
    private $entreprise;

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

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getExpediteur(): ?string
    {
        return $this->expediteur;
    }

    public function setExpediteur(string $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getDestinataire(): ?string
    {
        return $this->destinataire;
    }

    public function setDestinataire(string $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getCorrespondance(): ?correspondance
    {
        return $this->correspondance;
    }

    public function setCorrespondance(?correspondance $correspondance): self
    {
        $this->correspondance = $correspondance;

        return $this;
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

    public function getEntreprise(): ?entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
