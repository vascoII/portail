<?php

declare(strict_types=1);

namespace App\Http\Action\Ticketing;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Ticketing\TicketListUseCase;
use App\Application\Dto\Input\Ticketing\TicketListInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/ticketing/list', name: 'ticketing_list', methods: ['GET'])]
final class TicketListAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly TicketListUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new TicketListInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
