<?php

namespace App\Domain\Entities;

final class ProductVariants
{
    private string $id;
    private Product $product;
    private string $variantName;
    private string $size;
    private string $baseType;
    private string $adittionalPrice;

    private \DateTimeInterface|null $createdAt;
    private \DateTimeInterface|null $updatedAt;

    public function getId(): string
    {
        return $this->id;
    }
    public function getProduct(): Product
    {
        return $this->product;
    }
    public function getVariantName(): string
    {
        return $this->variantName;
    }
    public function getSize(): string
    {
        return $this->size;
    }
    public function getBaseType(): string
    {
        return $this->baseType;
    }
    public function getAdittionalPrice(): string
    {
        return $this->adittionalPrice;
    }

    
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }
    public function setProduct(Product $product): ProductVariants
    {
        $this->product = $product;
        return $this;
    }
    public function setVariantName(string $variantName): ProductVariants
    {
        $this->variantName = $variantName;
        return $this;
    }
    public function setSize(string $size): ProductVariants
    {
        $this->size = $size;
        return $this;
    }
    public function setBaseType(string $baseType): ProductVariants
    {
        $this->baseType = $baseType;
        return $this;
    }
    public function setAdittionalPrice(string $adittionalPrice): ProductVariants
    {
        $this->adittionalPrice = $adittionalPrice;
        return $this;
    }
    public function setCreatedAt(?\DateTimeInterface $createdAt): ProductVariants
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): ProductVariants
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }


}
