<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\AnomaliesUseCase;
use App\Application\Factory\Occupant\OccupantInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/occupant/anomalies', name: 'occupant_list_anomalies', methods: ['GET'])]
final class ListAnomaliesAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly AnomaliesUseCase $useCase,
    private readonly OccupantInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createAnomaliesFromRequest($request);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
