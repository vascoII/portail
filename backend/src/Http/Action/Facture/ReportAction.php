<?php

declare(strict_types=1);

namespace App\Http\Action\Facture;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Facture\ReportUseCase;
use App\Application\Factory\Shared\SharedInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/factures/{pkFacture}/report', name: 'facture_report', methods: ['GET'])]
final class ReportAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ReportUseCase $useCase,
    private readonly SharedInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createGetReportFromRoute($request, self::FACTURE, self::PARAM_PK_FACTURE);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
