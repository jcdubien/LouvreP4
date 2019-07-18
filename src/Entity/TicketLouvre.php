<?php

namespace App\Entity;

use App\Controller\IndexController;
use App\Validator\After14;
use App\Validator\LessThanThousand;
use App\Validator\SundaysAndHolidays;
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
     * @Assert\Length(
     *     min=2 ,max=20 ,
     *      minMessage="Trop court,vous devez rentrer au moins {{ limit }} caractères",
     *      maxMessage="Trop long"
     * )
     * @Assert\NotBlank()
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *     min=2,max=20 ,
     *      minMessage="Trop court , vous devez rentrer au moins {{ limit }} caractères",
     *      maxMessage="Trop long"
     * )
     * @Assert\NotBlank()
     */
    private $firstName;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date()
     * @Assert\Range(
     *      min = "-130 years",
     *      max = "now"
     * )
     * @Assert\NotBlank()
     */
    private $birthDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $halfDay;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reducedRate;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = "now",
     *      max = "+3 months"
     * )
     * @After14()
     * @SundaysAndHolidays()
     * @LessThanThousand()
     */
    private $dateTicket;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Orderlouvre", inversedBy="ticketLouvre")
     * @ORM\JoinColumn(nullable=false                        , referencedColumnName="id")
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

    public function getHalfDay(): ?bool
    {
        return $this->halfDay;
    }

    public function setHalfDay(bool $halfDay): self
    {
        $this->halfDay = $halfDay;

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

    public function getTicketPrice()
    {
        /**
         *Creating a configuration option for a value that you are never going to configure just isn't necessary.
         * Our recommendation is to define these values as constants in your application.
         * You could, for example, define a NUMBER_OF_ITEMS constant in the Post entity:
         * https://symfony.com/doc/current/best_practices/configuration.html#parameter-naming
         */
        $price = 0;
        $age = $this->getAge();

        if ($age->y < IndexController::AGE_CHILD) {
            $price = 0;
        } elseif ($age->y < IndexController::AGE_TEEN) {
            $price = 8;
        } elseif ($age->y >=IndexController::AGE_OLD) {
            $price = 12;
        } elseif ($this->getReducedRate()) {
            $price = 10;
        } else {
            ($price = 16);
        }

        return $price;
    }

    public function getAge()
    {
        $now = new \DateTime();
        $birthDate = $this->getBirthDate();
        $age = $birthDate->diff($now);
        return $age;
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

    public function getReducedRate(): ?bool
    {
        return $this->reducedRate;
    }

    public function setReducedRate(bool $reducedRate): self
    {
        $this->reducedRate = $reducedRate;

        return $this;
    }
}
