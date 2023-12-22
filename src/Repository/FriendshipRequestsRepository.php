<?php

namespace App\Repository;

use App\Entity\FriendshipRequests;
use App\Entity\user;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FriendshipRequests>
 *
 * @method FriendshipRequests|null find($id, $lockMode = null, $lockVersion = null)
 * @method FriendshipRequests|null findOneBy(array $criteria, array $orderBy = null)
 * @method FriendshipRequests[]    findAll()
 * @method FriendshipRequests[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FriendshipRequestsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FriendshipRequests::class);
    }

//    /**
//     * @return FriendshipRequests[] Returns an array of FriendshipRequests objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FriendshipRequests
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function getAllFriends(user $user): array
{
    return $this->createQueryBuilder('f')
        ->select('f.reciever')
        ->where('f.giver = :user')
        ->andWhere('f.status = :status')
        ->setParameter('user', $user)
        ->setParameter('status', 'accepted')
        ->getQuery()
        ->getResult()
    ;
}

public function getAllFriendshipRequests(user $user): array
{
    return $this->createQueryBuilder('f')
        ->select('f.reciever')
        ->where('f.giver = :user')
        ->andWhere('f.status = :status')
        ->setParameter('user', $user)
        ->setParameter('status', 'pending')
        ->getQuery()
        ->getResult()
    ;
}

}
