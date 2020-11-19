<?php


namespace App\Domain\Recipe;

use App\Domain\Ingredient\Ingredient;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Recipe\RecipeRepository")
 * @Vich\Uploadable()
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $filename = null;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="products_img", fileNameProperty="filename")
     * @Assert\File(mimeTypes = {"image/jpeg", "image/png"}, maxSize="2M")
     */
    private ?File $imageFile = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private string $name = '';

    /**
     * @ORM\Column(type="text")
     */
    private string $recipe = '';

    /**
     * @ORM\Column(type="string")
     */
    private string $slug = '';


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    public function setRecipe(string $recipe): self
    {
        $this->recipe = $recipe;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private ?DateTimeInterface $updatedAt = null;

    /**
     * @var Ingredient[]|Collection
     * @ORM\ManyToMany(targetEntity="App\Domain\Ingredient\Ingredient", cascade={"persist"})
     * @ORM\JoinColumn()
     * @ORM\OrderBy({"name": "ASC"})
     */
    private $ingredients;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function addIngredient(Ingredient ...$ingredients): void
    {
        foreach ($ingredients as $ingredient) {
            if (!$this->ingredients->contains($ingredient)) {
                $this->ingredients->add($ingredient);
            }
        }
    }

    public function removeIngredient(Ingredient $ingredient): void
    {
        $this->ingredients->removeElement($ingredient);
    }

    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): Recipe
    {
        $this->filename = $filename;
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): Recipe
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}