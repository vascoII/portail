<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Logement\ExportDysfunctionsUseCase;
use App\Application\Dto\Input\Logement\ExportDysfunctionsInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/logement/{pkLogement}/dysfonctionnements/export', name: 'logement_export_dysfunctions', methods: ['GET'])]
final class ExportDysfunctionsAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ExportDysfunctionsUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkLogement = (string) $request->attributes->get(self::PARAM_PK_LOGEMENT);
    $input = new ExportDysfunctionsInputDto($pkLogement);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
