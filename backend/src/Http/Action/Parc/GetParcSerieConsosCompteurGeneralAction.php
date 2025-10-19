<?php

declare(strict_types=1);

namespace App\Http\Action\Parc;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Parc\GetParcSerieConsosCompteurGeneralUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/parc_serie_consos_compteur_general', name: 'parc_serie_consos_compteur_general_get', methods: ['GET'])]
final class GetParcSerieConsosCompteurGeneralAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GetParcSerieConsosCompteurGeneralUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $output = $this->useCase->execute();
    return $this->responder->respond($output);
  }
}
