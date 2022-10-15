<?php

namespace App\Entity;

use App\Traits\EntityTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 */
class Property
{
    use EntityTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $title;

    /**
     * @ORM\Column(type="float")
     */
    private ?float $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $address;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $bedRoom;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $bathRoom;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isTv;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isKitchen;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isHeating;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isInternet;

    /**
     * @ORM\Column(type="boolean")
     */
    private ?bool $isAir;

    /**
     * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="property", orphanRemoval=true, cascade={"persist"})
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getBedRoom(): ?int
    {
        return $this->bedRoom;
    }

    public function setBedRoom(int $bedRoom): self
    {
        $this->bedRoom = $bedRoom;

        return $this;
    }

    public function getBathRoom(): ?int
    {
        return $this->bathRoom;
    }

    public function setBathRoom(int $bathRoom): self
    {
        $this->bathRoom = $bathRoom;

        return $this;
    }

    public function getIsTv(): ?bool
    {
        return $this->isTv;
    }

    public function setIsTv(bool $isTv): self
    {
        $this->isTv = $isTv;

        return $this;
    }

    public function getIsKitchen(): ?bool
    {
        return $this->isKitchen;
    }

    public function setIsKitchen(bool $isKitchen): self
    {
        $this->isKitchen = $isKitchen;

        return $this;
    }

    public function getIsHeating(): ?bool
    {
        return $this->isHeating;
    }

    public function setIsHeating(bool $isHeating): self
    {
        $this->isHeating = $isHeating;

        return $this;
    }

    public function getIsInternet(): ?bool
    {
        return $this->isInternet;
    }

    public function setIsInternet(bool $isInternet): self
    {
        $this->isInternet = $isInternet;

        return $this;
    }

    public function getIsAir(): ?bool
    {
        return $this->isAir;
    }

    public function setIsAir(bool $isAir): self
    {
        $this->isAir = $isAir;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setProperty($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getProperty() === $this) {
                $reservation->setProperty(null);
            }
        }

        return $this;
    }
}
