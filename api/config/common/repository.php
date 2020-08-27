<?php

use App\Components\FlusherInterface;
use App\Flusher;
use App\Market\Repository\InstrumentRepositoryInterface;
use App\Market\RepositoryDoctrine\InstrumentRepositoryDoctrine;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

return [
    FlusherInterface::class => function (ContainerInterface $container) {
        return new Flusher(
            $container->get(EntityManagerInterface::class)
        );
    },

    InstrumentRepositoryInterface::class => function (ContainerInterface $container) {
        return new InstrumentRepositoryDoctrine(
            $container->get(EntityManagerInterface::class)
        );
    }
];
