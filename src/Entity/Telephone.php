<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TelephoneRepository")
 */

use Symfony\Component\Validator\Constraints as Assert;

class Telephone
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $type;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     * @Assert\Range(
     *      min = 3,
     *      max = 7,
     *      minMessage = "La taille doit être supérieure à {{ limit }} pouces.",
     *      maxMessage = "La taille ne doit pas dépasser {{ limit }} pouces."
     * )
     */
     
    private $taille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getTaille()
    {
        return $this->taille;
    }

    public function setTaille($taille): self
    {
        $this->taille = $taille;

        return $this;
    }
}
