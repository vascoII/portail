<?php

declare(strict_types=1);

namespace App\Http\Action\Ticket;

use App\Application\Factory\Ticket\TicketInputFactory;
use App\Application\UseCase\Ticket\PatchTicketUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/ticket/{id}', name: 'ticket_patch', methods: ['PATCH'])]
final class PatchTicketAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly PatchTicketUseCase $useCase,
        private readonly TicketInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createGetByIdFromRequest($request, $args);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
