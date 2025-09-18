<?php

declare(strict_types=1);

namespace App\Http\Action\Ticketing;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Ticketing\CreateTicketUseCase;
use App\Application\Dto\Input\Ticketing\CreateTicketInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/ticketing/create', name: 'ticketing_create', methods: ['POST'])]
final class CreateTicketAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly CreateTicketUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $content = $request->toArray();
    $input = new CreateTicketInputDto($content);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
