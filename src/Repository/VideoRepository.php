<?php

namespace App\Repository;

use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Video|null find($id, $lockMode = null, $lockVersion = null)
 * @method Video|null findOneBy(array $criteria, array $orderBy = null)
 * @method Video[]    findAll()
 * @method Video[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    /**
     * @param string $search
     * @return Video[]
     */
    public function findBySearch(string $search): array
    {
        // SELECT * FROM video AS v
        $qb = $this->createQueryBuilder('v');

        // Filtrer par titre de video (champ title)
        // WHERE v.title LIKE '%recherche%'
        $qb
            ->where('v.title LIKE :search')
            ->setParameter('search', '%' . $search . '%')
        ;

        // search% => commence par search
        // %search => fini par search
        // %search% => contient search

        // SELECT * FROM video AS v WHERE v.title LIKE '%recherche%'

        // ORDER BY v.publishedAt DESC
        $qb->orderBy('v.publishedAt', 'DESC');
        // LIMIT 10
        $qb->setMaxResults(10);

        return $qb->getQuery()->getResult();
    }
    public function findByHome(): array
    {
        // SELECT * FROM video AS v
        $qb = $this->createQueryBuilder('v');

        // ORDER BY v.publishedAt DESC
        $qb->orderBy('v.publishedAt', 'DESC');

        // LIMIT 12
        $qb->setMaxResults(12);

        // SELECT * FROM video AS v WHERE v.title LIKE '%search%' ORDER BY v.publishedAt DESC LIMIT 10
        return $qb->getQuery()->getResult();
    }
}


