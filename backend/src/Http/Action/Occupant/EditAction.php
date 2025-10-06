<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Occupant\EditUseCase;
use App\Application\Factory\Occupant\OccupantInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/occupant/{pkOccupant}/edit', name: 'occupant_edit', methods: ['POST'])]
final class EditAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly EditUseCase $useCase,
    private readonly OccupantInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createEditFromRoute($request, self::PARAM_PK_LOGEMENT);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
