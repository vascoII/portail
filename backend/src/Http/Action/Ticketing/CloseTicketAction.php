<?php

declare(strict_types=1);

namespace App\Http\Action\Ticketing;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Ticketing\CloseTicketUseCase;
use App\Application\Dto\Input\Ticketing\CloseTicketInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/ticketing/{ticketId}/close', name: 'ticketing_close', methods: ['POST'])]
final class CloseTicketAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly CloseTicketUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkTicket = (string) $request->attributes->get(self::PARAM_PK_TICKET);
    $input = new CloseTicketInputDto($pkTicket);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
