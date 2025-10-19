<?php

declare(strict_types=1);

namespace App\Http\Action\Ticket;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Ticket\ListTicketsUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/tickets', name: 'ticket_list', methods: ['GET'])]
final class ListTicketsAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ListTicketsUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $output = $this->useCase->execute();
    return $this->responder->respond($output);
  }
}
