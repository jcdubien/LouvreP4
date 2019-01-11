<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderlouvreRepository")
 */
class Orderlouvre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2 , max=20 , minMessage="Trop court", maxMessage="Trop long")\length
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2 , max=20 , minMessage="Trop court", maxMessage="Trop long")\length
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Country()
     * @Assert\NotBlank()
     */
    private $country;
    

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TicketLouvre", mappedBy="OrderLouvre", orphanRemoval=true , cascade="all")
     */
    private $ticketLouvre;


    /**
     * @ORM\Column(type="datetime")
     *
     *
     */
    private $dateOrder;

    /**
     *
     * @ORM\Column(type="string", length=255)
     *
     */
    private $reference;







    public function __construct()
    {
        $this->ticketLouvre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getTotalPrice()
    {
        $price=0;

        foreach ($this->getTicketLouvre() as $ticket)
        {
            $price+=$ticket->getTicketPrice();

        }

        return $price;

    }



    public function getTicketNumber(): ?int
    {
        return $this->ticketNumber;
    }

    public function setTicketNumber(int $ticketNumber): self
    {
        $this->ticketNumber = $ticketNumber;

        return $this;
    }

    /**
     * @return Collection|TicketLouvre[]
     */
    public function getTicketLouvre(): Collection
    {
        return $this->ticketLouvre;
    }

    public function addTicketLouvre(TicketLouvre $ticketLouvre): self
    {
        if (!$this->ticketLouvre->contains($ticketLouvre)) {
            $this->ticketLouvre[] = $ticketLouvre;
            $ticketLouvre->setOrderLouvre($this);
        }

        return $this;
    }

    public function removeTicketLouvre(TicketLouvre $ticketLouvre): self
    {
        if ($this->ticketLouvre->contains($ticketLouvre)) {
            $this->ticketLouvre->removeElement($ticketLouvre);
            // set the owning side to null (unless already changed)
            if ($ticketLouvre->getOrderLouvre() === $this) {
                $ticketLouvre->setOrderLouvre(null);
            }
        }

        return $this;
    }

    public function getDateOrder(): ?\DateTimeInterface
    {
        return $this->dateOrder;
    }

    public function setDateOrder(\DateTimeInterface $dateOrder): self
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }


}
