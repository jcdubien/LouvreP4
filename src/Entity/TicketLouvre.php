<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketLouvreRepository")
 */
class TicketLouvre
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
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=2 , max=20 , minMessage="Trop court", maxMessage="Trop long")\length
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date()
     * @Assert\NotBlank()
     */
    private $birthDate;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Range(
     *      min = "-120 years",
     *      max = "now"
     * )
     *
     */
    private $halfDay;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reducedRate;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date()
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = "now",
     *      max = "+3 months"
     * )
     */
    private $dateTicket;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orderlouvre", inversedBy="ticketLouvre")
     * @ORM\JoinColumn(nullable=false , referencedColumnName="id")
     *
     */
    private $OrderLouvre;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getHalfDay(): ?bool
    {
        return $this->halfDay;
    }

    public function setHalfDay(bool $halfDay): self
    {
        $this->halfDay = $halfDay;

        return $this;
    }

    public function getReducedRate(): ?bool
    {
        return $this->reducedRate;
    }

    public function setReducedRate(bool $reducedRate): self
    {
        $this->reducedRate = $reducedRate;

        return $this;
    }

    public function getDateTicket(): ?\DateTimeInterface
    {
        return $this->dateTicket;
    }

    public function setDateTicket(\DateTimeInterface $dateTicket): self
    {
        $this->dateTicket = $dateTicket;

        return $this;
    }

    public function getOrderLouvre(): ?Orderlouvre
    {
        return $this->OrderLouvre;
    }

    public function setOrderLouvre(?Orderlouvre $OrderLouvre): self
    {
        $this->OrderLouvre = $OrderLouvre;

        return $this;
    }

    public function getAge()
    {
        $now=new \DateTime();
        $birthDate=$this->getBirthDate();
        $age=$birthDate->diff($now);
        return $age;

    }

    public function getTicketPrice()
    {
        $price=0;
        $age=$this->getAge();

        if ($age->y<4)
            {
                $price=0;
            }
        elseif ($age->y<12 or $age->y>60)
            {
                $price=8;
            }
        else if ($this->getReducedRate())
            {
                $price=10;

            }
        else ($price=12);

        return $price;

    }
}
