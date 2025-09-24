<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Logement\GetTicketOnwerUseCase;
use App\Application\Dto\Input\Logement\GetTicketOnwerInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/{pkImmeuble}/logements/ticketowner', name: 'logement_ticket_owner', methods: ['GET'])]
final class GetTicketOnwerAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly GetTicketOnwerUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $input = new GetTicketOnwerInputDto($pkImmeuble);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
