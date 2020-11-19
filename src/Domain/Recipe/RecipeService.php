<?php


namespace App\Domain\Recipe;


use Doctrine\ORM\EntityManagerInterface;

class RecipeService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($recipe)
    {
        $this->entityManager->persist($recipe);
        $this->entityManager->flush();
    }

}