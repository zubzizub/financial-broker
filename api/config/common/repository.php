<?php

use App\Components\FlusherInterface;
use App\Flusher;
use App\Market\Repository\InstrumentRepositoryInterface;
use App\Market\RepositoryDoctrine\InstrumentRepositoryDoctrine;
use Doctrine\ORM\EntityManagerInterface;
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
        return new InstrumentRepositoryDoctrine($entityManager);
    }
];
