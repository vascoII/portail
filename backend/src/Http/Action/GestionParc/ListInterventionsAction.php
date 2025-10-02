<?php

declare(strict_types=1);

namespace App\Http\Action\GestionParc;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\GestionParc\InterventionsUseCase;
use App\Application\Factory\GestionParc\GestionParcInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/gestionParc/{pkImmeuble}/interventions', name: 'gestionparc_list_interventions', methods: ['GET'])]
final class ListInterventionsAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly InterventionsUseCase $useCase,
    private readonly GestionParcInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createInterventionsFromRoute($request, self::PARAM_PK_IMMEUBLE);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
