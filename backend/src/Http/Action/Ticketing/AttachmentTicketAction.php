<?php

declare(strict_types=1);

namespace App\Http\Action\Ticketing;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Ticketing\AttachmentTicketUseCase;
use App\Application\Dto\Input\Ticketing\AttachmentTicketInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/ticketing/{ticketId}/attachments', name: 'ticketing_attachments', methods: ['GET'])]
final class AttachmentTicketAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly AttachmentTicketUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkTicket = (string) $request->attributes->get(self::PARAM_PK_TICKET);
    $input = new AttachmentTicketInputDto($pkTicket);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
