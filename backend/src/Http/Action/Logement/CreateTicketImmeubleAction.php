<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Logement\CreateTicketImmeubleUseCase;
use App\Application\Dto\Input\Logement\CreateTicketImmeubleInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/{pkImmeuble}/logements/createticket', name: 'logement_create_ticket_immeuble', methods: ['POST'])]
final class CreateTicketImmeubleAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly CreateTicketImmeubleUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $input = new CreateTicketImmeubleInputDto($pkImmeuble);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
