<?php

use App\Components\FlusherInterface;
use App\Flusher;
use App\Market\Entity\Instrument;
use App\Market\Entity\Transaction\Transaction;
use App\Market\Repository\InstrumentRepositoryInterface;
use App\Market\Repository\TransactionRepositoryInterface;
use App\Market\RepositoryDoctrine\InstrumentRepositoryDoctrine;
use App\Market\RepositoryDoctrine\TransactionRepositoryDoctrine;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Psr\Container\ContainerInterface;

return [
    FlusherInterface::class => function (ContainerInterface $container) {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);
        return new Flusher($entityManager);
    },

    InstrumentRepositoryInterface::class => function (ContainerInterface $container) {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);
        /** @var EntityRepository $repository */
        $repository = $entityManager->getRepository(Instrument::class);
        return new InstrumentRepositoryDoctrine($entityManager, $repository);
    },

    TransactionRepositoryInterface::class => function (ContainerInterface $container) {
        /** @var EntityManagerInterface $entityManager */
        $entityManager = $container->get(EntityManagerInterface::class);
        /** @var EntityRepository $repository */
        $repository = $entityManager->getRepository(Transaction::class);
        return new TransactionRepositoryDoctrine($entityManager, $repository);
    }
];
