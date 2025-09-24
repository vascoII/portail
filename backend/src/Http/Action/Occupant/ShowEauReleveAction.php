<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Occupant\ShowEauReleveUseCase;
use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/{pkOccupant}/releve_eau', name: 'occupant_eau_releve', methods: ['GET'])]
final class ShowEauReleveAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ShowEauReleveUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkOccupant = (string) $request->attributes->get(self::PARAM_PK_OCCUPANT);
    $input = new ShowEauReleveInputDto($pkOccupant);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
