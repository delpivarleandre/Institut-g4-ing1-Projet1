<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\tagArticle;
use App\Entity\tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findArticle($id)
    {
        return $this->createQueryBuilder('article')
            ->where('article.id= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    public function searchArticle($search)
    {
        return $this->createQueryBuilder('article')
            ->where('article.titre LIKE :search OR t.tag LIKE :search')
            ->leftJoin(tagArticle::class,'j','with','article.id = j.id_article')
            ->leftJoin(tag::class,'t','with','j.id_tag = t.id')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();
    }
    public function searchArticleExpanded($search)
    {
        return $this->createQueryBuilder('article')
            ->where('article.titre LIKE :search OR article.contenu LIKE :search OR t.tag LIKE :search')
            ->leftJoin(tagArticle::class,'j','with','article.id = j.id_article')
            ->leftJoin(tag::class,'t','with','j.id_tag = t.id')
            ->setParameter('search', '%'.$search.'%')
            ->getQuery()
            ->getResult();
    }

}
