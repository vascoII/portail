<?php

declare(strict_types=1);

namespace App\Http\Action\Ticketing;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Ticketing\TableTicketingUseCase;
use App\Application\Dto\Input\Ticketing\TableTicketingInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/ticketing/table', name: 'ticketing_table', methods: ['GET'])]
final class TableTicketingAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly TableTicketingUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new TableTicketingInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
