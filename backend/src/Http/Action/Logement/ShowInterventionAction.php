<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Logement\ShowInterventionUseCase;
use App\Application\Dto\Input\Logement\ShowInterventionInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/logement/{pkLogement}/interventions/{pkIntervention}', name: 'logement_show_intervention', methods: ['GET'])]
final class ShowInterventionAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ShowInterventionUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkLogement = (string) $request->attributes->get('pkLogement');
    $pkIntervention = (string) $request->attributes->get('pkIntervention');
    $input = new ShowInterventionInputDto($pkLogement, $pkIntervention);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
