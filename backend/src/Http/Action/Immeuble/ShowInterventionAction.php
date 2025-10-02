<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Immeuble\ShowInterventionUseCase;
use App\Application\Factory\Immeuble\ImmeubleInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/immeuble/{pkImmeuble}/interventions/{pkIntervention}', name: 'immeuble_show_intervention', methods: ['GET'])]
final class ShowInterventionAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ShowInterventionUseCase $useCase,
    private readonly ImmeubleInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createShowInterventionFromRoute($request, self::PARAM_PK_IMMEUBLE, self::PARAM_PK_INTERVENTION);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
