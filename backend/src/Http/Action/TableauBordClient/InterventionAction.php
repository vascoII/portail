<?php

declare(strict_types=1);

namespace App\Http\Action\TableauBordClient;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\TableauBordClient\InterventionUseCase;
use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/tableau-bord-client/interventions', name: 'tbc_interventions', methods: ['GET'])]
final class InterventionAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly InterventionUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new InterventionInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
