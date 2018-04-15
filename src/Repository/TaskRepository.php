<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Task::class);
    }

    public function findPendingTasks(User $user)
    {
        $queryBuilder = $this->createQueryBuilder('task');

        $queryBuilder
            ->where($queryBuilder->expr()->in('task.subject', ':subjects'))
            ->setParameter('subjects', $user->getSubjects())
        ;

        if (false === $user->getTasks()->isEmpty()) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->notIn('task', ':tasks'))
                ->setParameter('tasks', $user->getTasks() )
            ;
        }

        return $queryBuilder
            ->getQuery()
            ->execute()
        ;
    }
}
