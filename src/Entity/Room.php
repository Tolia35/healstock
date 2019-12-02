<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
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
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Roomitem", mappedBy="room")
     */
    private $roomitems;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Checklist", mappedBy="room")
     */
    private $checklists;

    public function __construct()
    {
        $this->roomitems = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
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
            $roomitem->setRoom($this);
        }
        return $this;
    }
    public function removeRoomitem(Roomitem $roomitem): self
    {
        if ($this->roomitems->contains($roomitem)) {
            $this->roomitems->removeElement($roomitem);
            // set the owning side to null (unless already changed)
            if ($roomitem->getRoom() === $this) {
                $roomitem->setRoom(null);
            }
        }
        return $this;
    }
    /**
     * @return Collection|Checklist[]
     */
    public function getChecklists(): Collection
    {
        return $this->checklists;
    }
    public function addChecklist(Checklist $checklist): self
    {
        if (!$this->checklists->contains($checklist)) {
            $this->checklists[] = $checklist;
            $checklist->setRoom($this);
        }
        return $this;
    }
    public function removeChecklist(Checklist $checklist): self
    {
        if ($this->checklists->contains($checklist)) {
            $this->checklists->removeElement($checklist);
            // set the owning side to null (unless already changed)
            if ($checklist->getRoom() === $this) {
                $checklist->setRoom(null);
            }
        }
        return $this;
    }
}