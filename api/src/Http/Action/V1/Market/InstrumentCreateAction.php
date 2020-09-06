<?php

namespace App\Http\Action\V1\Market;

use App\Http\EmptyResponse;
use App\Http\Validator\Validator;
use App\Market\UseCase\AddInstrument\Command;
use App\Market\UseCase\AddInstrument\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Exception;

class InstrumentCreateAction implements RequestHandlerInterface
{
    private Handler $handler;
    private Validator $validator;

    public function __construct(Handler $handler, Validator $validator)
    {
        $this->handler = $handler;
        $this->validator = $validator;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /**
         * @psalm-var array{code:?string, name:?string} $data
         */
        $data = $request->getParsedBody();

        $command = new Command();
        $command->code = $data['code'] ?? '';
        $command->name = $data['name'] ?? '';

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new EmptyResponse(201);
    }
}
