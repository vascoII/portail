<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\ShowEauReleveUseCase;
use App\Application\Factory\Occupant\OccupantInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/occupant/{pkOccupant}/releve_eau', name: 'occupant_eau_releve', methods: ['GET'])]
final class ShowEauReleveAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ShowEauReleveUseCase $useCase,
    private readonly OccupantInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createShowEauReleveFromRoute($request, self::PARAM_PK_OCCUPANT);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
