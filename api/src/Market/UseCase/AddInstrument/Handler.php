<?php

namespace App\Market\UseCase\AddInstrument;

use App\Components\FlusherInterface;
use App\Market\Entity\Instrument;
use App\Market\Repository\InstrumentRepositoryInterface;
use Exception;

class Handler
{
    private InstrumentRepositoryInterface $instrumentRepository;
    private FlusherInterface $flusher;

    public function __construct(
        InstrumentRepositoryInterface $instrumentRepository,
        FlusherInterface $flusher
    ) {
        $this->instrumentRepository = $instrumentRepository;
        $this->flusher = $flusher;
    }

    /**
     * @param Command $command
     * @return string
     * @throws Exception
     */
    public function handle(Command $command): string
    {
        $instrument = new Instrument($command->code, $command->title);

        $this->instrumentRepository->add($instrument);
        $this->flusher->flush();
        return $instrument->getId();
    }
}
