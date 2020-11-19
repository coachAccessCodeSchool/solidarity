<?php


namespace App\Http\Controller;


use App\Domain\Merchant\MerchantRepository;
use App\Domain\Recipe\RecipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

    private MerchantRepository $merchantRepository;
    private RecipeRepository $recipeRepository;

    public function __construct(MerchantRepository $merchantRepository,
                                RecipeRepository $recipeRepository
    )
    {
        $this->merchantRepository = $merchantRepository;
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('site/index.html.twig', [
            'recipes' => $this->recipeRepository->findAll()
        ]);
    }

}