<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Occupant\ShowInterventionUseCase;
use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/occupant/interventions/{pkIntervention}', name: 'occupant_show_intervention', methods: ['GET'])]
final class ShowInterventionAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ShowInterventionUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkIntervention = (string) $request->attributes->get(self::PARAM_PK_INTERVENTION);
    $input = new ShowInterventionInputDto($pkIntervention);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
