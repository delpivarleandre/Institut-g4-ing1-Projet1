<?php

namespace App\Repository;

use App\Entity\TagArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TagArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method TagArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method TagArticle[]    findAll()
 * @method TagArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TagArticle::class);
    }

    // /**
    //  * @return TagArticle[] Returns an array of TagArticle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TagArticle
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findTagByArticle($id)
    {
        return $this->createQueryBuilder('tag_article')
            ->where('tag_article.id_article= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    public function deleteAllbyArticle($id)
    {
        return $this->createQueryBuilder('tag_article')
            ->delete()
            ->where('tag_article.id_article= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
