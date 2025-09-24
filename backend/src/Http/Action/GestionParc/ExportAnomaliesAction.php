<?php

declare(strict_types=1);

namespace App\Http\Action\GestionParc;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\GestionParc\ExportAnomaliesUseCase;
use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/gestionParc/{pkImmeuble}/anomalies/export', name: 'gestionparc_export_anomalies', methods: ['GET'])]
final class ExportAnomaliesAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ExportAnomaliesUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = (string) $request->attributes->get(self::PARAM_PK_IMMEUBLE);
    $input = new ExportAnomaliesInputDto($pkImmeuble);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
