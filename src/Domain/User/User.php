<?php


namespace App\Domain\User;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Domain\User\UserRepository")
 * @UniqueEntity("username", message="Le nom d\'utilisateur est déjà existant !")
 */
class User implements UserInterface, \Serializable
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=20)
     * @Assert\Regex("/^[a-zA-Z][a-zA-Z0-9]+$/")
     */
    private string $username = '';

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $password = '';

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = ['ROLE_USER'];

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private ?DateTimeInterface $joinedAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getJoinedAt(): ?DateTimeInterface
    {
        return $this->joinedAt;
    }

    public function setJoinedAt(?DateTimeInterface $joinedAt): User
    {
        $this->joinedAt = $joinedAt;
        return $this;
    }
}