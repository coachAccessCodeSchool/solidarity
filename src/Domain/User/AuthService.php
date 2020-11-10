<?php

namespace App\Domain\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthService
{
    private EntityManagerInterface $em;
    private UserPasswordEncoderInterface $encoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder)
    {
        $this->em = $em;
        $this->encoder = $encoder;
    }

    public function register(User $user): void
    {
        $hash = $this->encoder->encodePassword($user, $user->getPassword());
        $user
            ->setPassword($hash)
            ->setJoinedAt(new \DateTime())
            ->setRoles(["ROLE_USER"])
        ;
        $this->em->persist($user);
        $this->em->flush();
    }
}