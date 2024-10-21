<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    // lets create tri function
    public function tri()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            'SELECT b FROM App\Entity\Book b ORDER BY b.title ASC'
        );

        return $query->getResult();
    }

    public function searchByTitle($title)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.title LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->orderBy('b.title', 'ASC')
            ->getQuery()
            ->getResult();
    }



}
