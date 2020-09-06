<?php

namespace App\Http\Action\V1\Market;

use App\Http\EmptyResponse;
use App\Http\Validator\Validator;
use App\Market\UseCase\AddTransaction\Command;
use App\Market\UseCase\AddTransaction\Handler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Exception;
use Psr\Http\Server\RequestHandlerInterface;

class TransactionCreateAction implements RequestHandlerInterface
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
        $data = $request->getParsedBody();

        $command = new Command();
        $command->instrumentId = $data['instrumentId'] ?? '';
        $command->direction = $data['direction'] ?? '';
        $command->price = $data['price'] ?? '';
        $command->count = $data['count'] ?? '';
        $command->comment = $data['comment'] ?? '';

        $this->validator->validate($command);

        $this->handler->handle($command);

        return new EmptyResponse(201);
    }
}
