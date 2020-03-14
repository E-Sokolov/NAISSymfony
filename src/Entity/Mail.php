<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MailRepository")
 */
class Mail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $email_type;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $erk;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $coment1;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $coment2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orgtype;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $position;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEmailType(): ?string
    {
        return $this->email_type;
    }

    public function setEmailType(?string $email_type): self
    {
        $this->email_type = $email_type;

        return $this;
    }

    public function getErk(): ?string
    {
        return $this->erk;
    }

    public function setErk(?string $erk): self
    {
        $this->erk = $erk;

        return $this;
    }

    public function getDate1(): ?\DateTimeInterface
    {
        return $this->date1;
    }

    public function setDate1(?\DateTimeInterface $date1): self
    {
        $this->date1 = $date1;

        return $this;
    }

    public function getComent1(): ?string
    {
        return $this->coment1;
    }

    public function setComent1(?string $coment1): self
    {
        $this->coment1 = $coment1;

        return $this;
    }

    public function getDate2(): ?\DateTimeInterface
    {
        return $this->date2;
    }

    public function setDate2(?\DateTimeInterface $date2): self
    {
        $this->date2 = $date2;

        return $this;
    }

    public function getComent2(): ?string
    {
        return $this->coment2;
    }

    public function setComent2(?string $coment2): self
    {
        $this->coment2 = $coment2;

        return $this;
    }

    public function getOrgtype(): ?string
    {
        return $this->orgtype;
    }

    public function setOrgtype(?string $orgtype): self
    {
        $this->orgtype = $orgtype;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }
}
