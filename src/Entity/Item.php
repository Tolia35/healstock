<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $information;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Roomitem", mappedBy="item")
     */
    private $roomitems;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Checklistitem", mappedBy="item")
     */
    private $checklistitems;
    public function __construct()
    {
        $this->roomitems = new ArrayCollection();
        $this->checklistitems = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getReference(): ?string
    {
        return $this->reference;
    }
    public function setReference(?string $reference): self
    {
        $this->reference = $reference;
        return $this;
    }
    public function getInformation(): ?string
    {
        return $this->information;
    }
    public function setInformation(?string $information): self
    {
        $this->information = $information;
        return $this;
    }
    /**
     * @return Collection|Roomitem[]
     */
    public function getRoomitems(): Collection
    {
        return $this->roomitems;
    }
    public function addRoomitem(Roomitem $roomitem): self
    {
        if (!$this->roomitems->contains($roomitem)) {
            $this->roomitems[] = $roomitem;
            $roomitem->setItem($this);
        }
        return $this;
    }
    public function removeRoomitem(Roomitem $roomitem): self
    {
        if ($this->roomitems->contains($roomitem)) {
            $this->roomitems->removeElement($roomitem);
            // set the owning side to null (unless already changed)
            if ($roomitem->getItem() === $this) {
                $roomitem->setItem(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Checklistitem[]
     */
    public function getChecklistitems(): Collection
    {
        return $this->checklistitems;
    }
    public function addChecklistitem(Checklistitem $checklistitem): self
    {
        if (!$this->checklistitems->contains($checklistitem)) {
            $this->checklistitems[] = $checklistitem;
            $checklistitem->setItem($this);
        }
        return $this;
    }
    public function removeChecklistitem(Checklistitem $checklistitem): self
    {
        if ($this->checklistitems->contains($checklistitem)) {
            $this->checklistitems->removeElement($checklistitem);
            // set the owning side to null (unless already changed)
            if ($checklistitem->getItem() === $this) {
                $checklistitem->setItem(null);
            }
        }
        return $this;
    }
}