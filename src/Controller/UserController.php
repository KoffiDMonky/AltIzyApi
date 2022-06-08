<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\EventListener\ControllerListener;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/api")
 */
class UserController extends AbstractController
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHashe
    ) {}

    /**
     * @Route(
     *     name="api_users_post",
     *     path="/users",
     *     methods={"POST"},
     *     defaults={
     *         "_api_resource_class"= User::class,
     *         "_api_collection_operation_name"="post"
     *     }
     * )
     */
    public function postAction(User $data, UserPasswordHasherInterface $passwordHasher): User
    {

        return $this->hashPassword($data, $passwordHasher);
    }

    /**
     * @Route(
     *     name="api_users_put",
     *     path="/users/{id}",
     *     requirements={"id"="\d+"},
     *     methods={"PUT"},
     *     defaults={
     *         "_api_resource_class"=User::class,
     *         "_api_item_operation_name"="put"
     *     }
     * )
     */
    public function putAction(User $data, UserPasswordHasherInterface $passwordHasher): User
    {
        return $this->passwordHasher->hashPassword($data, $passwordHasher);
    }

    protected function hashPassword(User $data, UserPasswordHasherInterface $passwordHasher): User
    {
        $hashed = $passwordHasher->hashPassword($data, $data->getPassword());
        $data->setPassword($hashed);

        return $data->setPassword($hashed);
    }
}