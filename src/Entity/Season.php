<?php

namespace App\Entity;

use App\Repository\SeasonsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SeasonsRepository::class)]
class Season
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $firstAirDate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $overview = null;

    #[ORM\Column(nullable: true)]
    private ?int $tmdbId = null;

    #[ORM\Column(length: 255)]
    private ?string $poster = null;

    #[ORM\Column]
    private ?\DateTime $datetime = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateModified = null;

    #[ORM\ManyToOne(inversedBy: 'seasons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?serie $serie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getFirstAirDate(): ?\DateTime
    {
        return $this->firstAirDate;
    }

    public function setFirstAirDate(\DateTime $firstAirDate): static
    {
        $this->firstAirDate = $firstAirDate;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    public function getTmdbId(): ?int
    {
        return $this->tmdbId;
    }

    public function setTmdbId(?int $tmdbId): static
    {
        $this->tmdbId = $tmdbId;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): static
    {
        $this->poster = $poster;

        return $this;
    }

    public function getDatetime(): ?\DateTime
    {
        return $this->datetime;
    }

    public function setDateCreated(\DateTime $DateCreated): static
    {
        $this->datetime = $DateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTime
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTime $dateModified): static
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getSerie(): ?serie
    {
        return $this->serie;
    }

    public function setSerie(?serie $serie): static
    {
        $this->serie = $serie;

        return $this;
    }
}
