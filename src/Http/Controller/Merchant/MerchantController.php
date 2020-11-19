<?php


namespace App\Http\Controller\Merchant;


use App\Domain\Merchant\Merchant;
use App\Domain\Merchant\MerchantService;
use App\Http\Form\Merchant\CreateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/merchant")
 * Class MerchantController
 * @package App\Http\Controller\Merchant
 */
class MerchantController extends AbstractController
{

    private MerchantService $merchantService;

    public function __construct(MerchantService $merchantService)
    {
        $this->merchantService = $merchantService;
    }


    /**
     * @Route("/", name="index_merchant")
     */
    public function index()
    {
        return $this->render('merchant/index.html.twig');
    }

    /*
    /**
     * @Route("/recipe/create", name="create_marchant")
     */
    /*
    public function create(Request $request)
    {
        $merchant = new Merchant();
        $form = $this->createForm(CreateType::class, $merchant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->merchantService->create($merchant);
        }
        return $this->render('merchant/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
    */

    /**
     * @Route("/info", name="info_merchant")
     */
    public function info()
    {
        return $this->render('merchant/info.html.twig');
    }


}