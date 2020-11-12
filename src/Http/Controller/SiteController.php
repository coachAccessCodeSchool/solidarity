<?php


namespace App\Http\Controller;


use App\Domain\Merchant\MerchantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

    private MerchantRepository $merchantRepository;

    public function __construct(MerchantRepository $merchantRepository)
    {
        $this->merchantRepository = $merchantRepository;
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('site/index.html.twig', [
            //'merchants' => $this->merchantRepository->findAll()
        ]);
    }

}