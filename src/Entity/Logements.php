<?php

namespace App\Entity;

use App\Repository\LogementsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: LogementsRepository::class)]
#[ApiResource]
class Logements
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $rating = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column]
    private ?int $chambres = null;

    #[ORM\Column]
    private ?int $douche = null;

    #[ORM\Column]
    private ?int $superficie = null;

    #[ORM\OneToMany(mappedBy: 'id_logements', targetEntity: Photos::class,cascade: ["persist", "remove"])]
    private Collection $id_photos;

    #[ORM\Column]
    private ?int $rentalready = null;

    #[ORM\Column]
    private ?int $prixmoyen = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionlg = null;

    #[ORM\Column]
    private ?int $salledebains = null;

    #[ORM\Column]
    private ?int $lits = null;

    #[ORM\Column(nullable: true)]
    private ?int $misenavant = null;

    #[ORM\Column(length: 255)]
    private ?string $arrondissements = null;

    #[ORM\Column]
    private ?int $nbpieces = null;

    public function __construct()
    {
        $this->id_photos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getChambres(): ?int
    {
        return $this->chambres;
    }

    public function setChambres(int $chambres): static
    {
        $this->chambres = $chambres;

        return $this;
    }

    public function getDouche(): ?int
    {
        return $this->douche;
    }

    public function setDouche(int $douche): static
    {
        $this->douche = $douche;

        return $this;
    }

    public function getSuperficie(): ?int
    {
        return $this->superficie;
    }

    public function setSuperficie(int $superficie): static
    {
        $this->superficie = $superficie;

        return $this;
    }

    /**
     * @return Collection<int, Photos>
     */
    public function getIdPhotos(): Collection
    {
        return $this->id_photos;
    }

    public function addIdPhoto(Photos $idPhoto): static
    {
        if (!$this->id_photos->contains($idPhoto)) {
            $this->id_photos->add($idPhoto);
            $idPhoto->setIdLogements($this);
        }

        return $this;
    }

    public function removeIdPhoto(Photos $idPhoto): static
    {
        if ($this->id_photos->removeElement($idPhoto)) {
            // set the owning side to null (unless already changed)
            if ($idPhoto->getIdLogements() === $this) {
                $idPhoto->setIdLogements(null);
            }
        }

        return $this;
    }

    public function getRentalready(): ?int
    {
        return $this->rentalready;
    }

    public function setRentalready(int $rentalready): static
    {
        $this->rentalready = $rentalready;

        return $this;
    }

    public function getPrixmoyen(): ?int
    {
        return $this->prixmoyen;
    }

    public function setPrixmoyen(int $prixmoyen): static
    {
        $this->prixmoyen = $prixmoyen;

        return $this;
    }

    public function getDescriptionlg(): ?string
    {
        return $this->descriptionlg;
    }

    public function setDescriptionlg(string $descriptionlg): static
    {
        $this->descriptionlg = $descriptionlg;

        return $this;
    }

    public function getSalledebains(): ?int
    {
        return $this->salledebains;
    }

    public function setSalledebains(int $salledebains): static
    {
        $this->salledebains = $salledebains;

        return $this;
    }

    public function getLits(): ?int
    {
        return $this->lits;
    }

    public function setLits(int $lits): static
    {
        $this->lits = $lits;

        return $this;
    }

    public function getMisenavant(): ?int
    {
        return $this->misenavant;
    }

    public function setMisenavant(?int $misenavant): static
    {
        $this->misenavant = $misenavant;

        return $this;
    }

    public function getArrondissements(): ?string
    {
        return $this->arrondissements;
    }

    public function setArrondissements(string $arrondissements): static
    {
        $this->arrondissements = $arrondissements;

        return $this;
    }

    public function getNbpieces(): ?int
    {
        return $this->nbpieces;
    }

    public function setNbpieces(int $nbpieces): static
    {
        $this->nbpieces = $nbpieces;

        return $this;
    }

}
