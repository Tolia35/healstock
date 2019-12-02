<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\ChecklistRepository")
 */
class Checklist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nurseName;
    /**
     * @ORM\Column(type="datetime")
     */
    private $createTime;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="checklists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Checklistitem", mappedBy="checklist")
     */
    private $checklistitems;
    public function __construct()
    {
        $this->checklistitems = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getNurseName(): ?string
    {
        return $this->nurseName;
    }
    public function setNurseName(string $nurseName): self
    {
        $this->nurseName = $nurseName;
        return $this;
    }
    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->createTime;
    }
    public function setCreateTime(\DateTimeInterface $createTime): self
    {
        $this->createTime = $createTime;
        return $this;
    }
    public function getRoom(): ?Room
    {
        return $this->room;
    }
    public function setRoom(?Room $room): self
    {
        $this->room = $room;
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
            $checklistitem->setChecklist($this);
        }
        return $this;
    }
    public function removeChecklistitem(Checklistitem $checklistitem): self
    {
        if ($this->checklistitems->contains($checklistitem)) {
            $this->checklistitems->removeElement($checklistitem);
            // set the owning side to null (unless already changed)
            if ($checklistitem->getChecklist() === $this) {
                $checklistitem->setChecklist(null);
            }
        }
        return $this;
    }

    public function isClosed() {
        foreach ($this->getChecklistitems() as $item) {
            if (!$item->getIsClosed()) {
                return false;
            }
        }
        return true;
    }
}