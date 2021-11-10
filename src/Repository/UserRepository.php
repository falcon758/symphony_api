<?php

/**
 * User Repository
 * php version 7.6
 *
 * @category Api
 * @package  Symphony_Api
 * @author   User <user@log.pt>
 * @license  MIT License (c) copyright 2011-2013 original author or authors
 * @link     https://github.com/falcon758/symphony_api
 */

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class UserRepository
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
class UserRepository extends ServiceEntityRepository
{
    /**
     * Constructor
     * 
     * @param ManagerRegistry $registry Manager registry
     * 
     * @return void
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
}
