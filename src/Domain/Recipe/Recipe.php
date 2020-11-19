<?php


namespace App\Domain\Recipe;

use App\Domain\Ingredient\Ingredient;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Recipe\RecipeRepository")
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
}