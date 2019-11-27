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
     * @ORM\Column(type="string", length=50)
     * @ORM\JoinColumn(nullable=false)
     */
    private $name;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Roomitem", mappedBy="room")
     */
    private $roomitems;
    public function __construct()
    {
        $this->name = new ArrayCollection();
        $this->roomitems = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return Collection|Checklist[]
     */
    public function getName(): Collection
    {
        return $this->name;
    }
    public function addName(Checklist $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name[] = $name;
            $name->setRoom($this);
        }
        return $this;
    }
    public function removeName(Checklist $name): self
    {
        if ($this->name->contains($name)) {
            $this->name->removeElement($name);
            // set the owning side to null (unless already changed)
            if ($name->getRoom() === $this) {
                $name->setRoom(null);
            }
        }
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
}