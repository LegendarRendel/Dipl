<?php

namespace App\Entity;

use App\Repository\ShopItemsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Type;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass=ShopItemsRepository::class)
 */
class ShopItems
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @ORM\OneToMany(targetEntity=ShopCart::class, mappedBy="shopItem", orphanRemoval=true)
     *
     * @var Collection<int, ShopCart>
     */
    private Collection $shopCarts;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $image;

    /**
     * @ORM\Column(type="integer")
     */
    private int $Count;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $Region;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $Activ;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $OSMin;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $ProcessorMin;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $MemoryMin;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $GraphicsMin;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $DirectXMin;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $HardDriveMin;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $OSMax;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $ProcessorMax;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $MemoryMax;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $GraphicsMax;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $DirectXMax;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private string $HardDriveMax;

    public function __construct()
    {
        $this->shopCarts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, ShopCart>
     */
    public function getShopCarts(): Collection
    {
        return $this->shopCarts;
    }

    public function addShopCart(ShopCart $shopCart): self
    {
        if (!$this->shopCarts->contains($shopCart)) {
            $this->shopCarts[] = $shopCart;
            $shopCart->setShopItem($this);
        }

        return $this;
    }

    public function removeShopCart(ShopCart $shopCart): self
    {
        if ($this->shopCarts->contains($shopCart)) {
            $this->shopCarts->removeElement($shopCart);
            // set the owning side to null (unless already changed)
            if ($shopCart->getShopItem() === $this) {
                $shopCart->setShopItem(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getActiv(): ?string
    {
        return $this->Activ;
    }

    public function setActiv(string $Activ): self
    {
        $this->Activ = $Activ;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getCount(): ?int
    {
        return $this->Count;
    }

    public function setCount(int $Count): self
    {
        $this->Count = $Count;

        return $this;
    }

    public function getOSMin(): ?string
    {
        return $this->OSMin;
    }

    public function setOSMin(string $OSMin): self
    {
        $this->OSMin = $OSMin;

        return $this;
    }

    public function getProcessorMin(): ?string
    {
        return $this->ProcessorMin;
    }

    public function setProcessorMin(string $ProcessorMin): self
    {
        $this->ProcessorMin = $ProcessorMin;

        return $this;
    }

    public function getMemoryMin(): ?string
    {
        return $this->MemoryMin;
    }

    public function setMemoryMin(string $MemoryMin): self
    {
        $this->MemoryMin = $MemoryMin;

        return $this;
    }

    public function getGraphicsMin(): ?string
    {
        return $this->GraphicsMin;
    }

    public function setGraphicsMin(string $GraphicsMin): self
    {
        $this->GraphicsMin = $GraphicsMin;

        return $this;
    }

    public function getDirectXMin(): ?string
    {
        return $this->DirectXMin;
    }

    public function setDirectXMin(string $DirectXMin): self
    {
        $this->DirectXMin = $DirectXMin;

        return $this;
    }

    public function getHardDriveMin(): ?string
    {
        return $this->HardDriveMin;
    }

    public function setHardDriveMin(string $HardDriveMin): self
    {
        $this->HardDriveMin = $HardDriveMin;

        return $this;
    }

    public function getOSMax(): ?string
    {
        return $this->OSMax;
    }

    public function setOSMax(string $OSMax): self
    {
        $this->OSMax = $OSMax;

        return $this;
    }

    public function getProcessorMax(): ?string
    {
        return $this->ProcessorMax;
    }

    public function setProcessorMax(string $ProcessorMax): self
    {
        $this->ProcessorMax = $ProcessorMax;

        return $this;
    }

    public function getMemoryMax(): ?string
    {
        return $this->MemoryMax;
    }

    public function setMemoryMax(string $MemoryMax): self
    {
        $this->MemoryMax = $MemoryMax;

        return $this;
    }

    public function getGraphicsMax(): ?string
    {
        return $this->GraphicsMax;
    }

    public function setGraphicsMax(string $GraphicsMax): self
    {
        $this->GraphicsMax = $GraphicsMax;

        return $this;
    }

    public function getDirectXMax(): ?string
    {
        return $this->DirectXMax;
    }

    public function setDirectXMax(string $DirectXMax): self
    {
        $this->DirectXMax = $DirectXMax;

        return $this;
    }

    public function getHardDriveMax(): ?string
    {
        return $this->HardDriveMax;
    }

    public function setHardDriveMax(string $HardDriveMax): self
    {
        $this->HardDriveMax = $HardDriveMax;

        return $this;
    }
}
