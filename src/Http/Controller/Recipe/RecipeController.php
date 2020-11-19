<?php


namespace App\Http\Controller\Recipe;


use App\Domain\Recipe\Recipe;
use App\Domain\Recipe\RecipeService;
use App\Http\Form\Recipe\RecipeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recipe")
 * Class RecipeController
 * @package App\Http\Controller\RecipeController
 */
class RecipeController extends AbstractController
{

    private RecipeService $recipeService;

    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }


    /**
     * @Route("/create", name="create_recipe")
     */
    public function create(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->recipeService->create($recipe);
            $this->addFlash('success', 'Recette créer ! Merci de votre contribution !');
        }
        return $this->render('recipe/create.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView()
        ]);
    }

}