<?php

declare(strict_types=1);

namespace App\Http\Action\Ticketing;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Ticketing\CreateTicketUseCase;
use App\Application\Factory\Ticketing\TicketingInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/ticketing/create', name: 'ticketing_create', methods: ['POST'])]
final class CreateTicketAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly CreateTicketUseCase $useCase,
    private readonly TicketingInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createCreateTicketInterFromRequest($request);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
