<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CallsRepository")
 */
class Calls
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $region;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $client_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fio;

    /**
     * @ORM\Column(type="integer")
     */
    private $resource;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $what_to_do;

    /**
     * @ORM\Column(type="integer")
     */
    private $ingeneer;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_success;

    /**
     * @ORM\Column(type="boolean")
     */
    private $service;

    /**
     * @ORM\Column(type="boolean")
     */
    private $trip;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $etc_data;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getClientType(): ?string
    {
        return $this->client_type;
    }

    public function setClientType(string $client_type): self
    {
        $this->client_type = $client_type;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(?string $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    public function getResource(): ?int
    {
        return $this->resource;
    }

    public function setResource(int $resource): self
    {
        $this->resource = $resource;

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

    public function getWhatToDo(): ?string
    {
        return $this->what_to_do;
    }

    public function setWhatToDo(?string $what_to_do): self
    {
        $this->what_to_do = $what_to_do;

        return $this;
    }

    public function getIngeneer(): ?int
    {
        return $this->ingeneer;
    }

    public function setIngeneer(int $ingeneer): self
    {
        $this->ingeneer = $ingeneer;

        return $this;
    }

    public function getDateSuccess(): ?\DateTimeInterface
    {
        return $this->date_success;
    }

    public function setDateSuccess(?\DateTimeInterface $date_success): self
    {
        $this->date_success = $date_success;

        return $this;
    }

    public function getService(): ?bool
    {
        return $this->service;
    }

    public function setService(bool $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getTrip(): ?bool
    {
        return $this->trip;
    }

    public function setTrip(bool $trip): self
    {
        $this->trip = $trip;

        return $this;
    }

    public function getEtcData(): ?string
    {
        return $this->etc_data;
    }

    public function setEtcData(?string $etc_data): self
    {
        $this->etc_data = $etc_data;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
