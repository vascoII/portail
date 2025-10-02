<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\InterventionsUseCase;
use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/interventions/export', name: 'occupant_export_interventions', methods: ['GET'])]
final class ExportInterventionsAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly InterventionsUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new InterventionsInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
