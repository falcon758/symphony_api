<?php

/**
 * User Controller
 * php version 7.6
 *
 * @category Api
 * @package  Symphony_Api
 * @author   User <user@log.pt>
 * @license  MIT License (c) copyright 2011-2013 original author or authors
 * @link     https://github.com/falcon758/symphony_api
 */

namespace App\Controller;

use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class UserController
 * php version 7.6
 *
 * @category Api
 * @package  Symphony_Api
 * @author   User <user@log.pt>
 * @license  MIT License (c) copyright 2011-2013 original author or authors
 * @link     https://github.com/falcon758/symphony_api
 * 
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserController extends AbstractController
{
    /**
     * @Route("api/user", name="getUser", methods={"GET"})
     */
    public function getUser(Request $request, UserRepository $userRepository): Response
    {
        $json = $request->getContent();
        $idUser = json_decode($json)->id;
        return $this->json($userRepository->find($idUser), 200, [], ['groups'=>'user:read']);
    }

    /**
     * @Route("api/user", name="AddUser", methods={"POST"})
     */
    public function addUser(Request $request, EntityManagerInterface $em, ValidatorInterface $validator,
        SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $user = $serializer->deserialize($json, User::class, 'json');
        $error = $validator->validate($user);
        if (! is_null($error)) {
            return $this->json($error,400);
        } else {
            $em->persist($user);
            $em->flush();
            return $this->json($user, 201);
        }
    }

    /**
     * @Route("api/user", name="RmUser", methods={"POST"})
     */
    public function rmUser(Request $request, EntityManagerInterface $em, ValidatorInterface $validator,
        SerializerInterface $serializer): Response
    {
        $json = $request->getContent();
        $idUser = json_decode($json)->id;

        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $user = $userRepository->find($idUser);

        if (is_null($user)) {
            return $this->json(['error' => "User do not exists"], 400);
        }

        $em->remove($user);
        $em->flush();

        return $this->json(['success' => "User removed"], 200);
    }
}
