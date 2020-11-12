<?php

namespace App\Domain\Merchant;

use Doctrine\ORM\EntityManagerInterface;

class MerchantService
{

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create($merchant)
    {
        $this->em->persist($merchant);
        $this->em->flush();
    }

}