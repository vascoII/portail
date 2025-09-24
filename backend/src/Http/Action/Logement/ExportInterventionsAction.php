<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Logement\ExportInterventionsUseCase;
use App\Application\Dto\Input\Logement\ExportInterventionsInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/logement/{pkLogement}/interventions/export', name: 'logement_export_interventions', methods: ['GET'])]
final class ExportInterventionsAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ExportInterventionsUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkLogement = (string) $request->attributes->get(self::PARAM_PK_LOGEMENT);
    $input = new ExportInterventionsInputDto($pkLogement);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
