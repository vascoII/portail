<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Pdf;

use App\Application\UseCase\Document\GenerateDocumentPdfUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/document/immeuble/{pkImmeuble}/releve/pdf', name: 'document_immeuble_releve_pdf', methods: ['POST'])]
final class GenerateImmeubleRelevePdfAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateDocumentPdfUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = $request->attributes->get('pkImmeuble');
    $date = $request->query->get('date', '');
    $energie = $request->query->get('energie', 'EAU');

    // Déterminer le ReportType selon l'énergie
    $reportType = match ($energie) {
      'EAU' => 'RELEVE_EAU_IMMEUBLE',
      'REPART' => 'RELEVE_REPART_IMMEUBLE',
      'CET' => 'RELEVE_CET_IMMEUBLE',
      default => 'RELEVE_EAU_IMMEUBLE'
    };

    $output = $this->useCase->execute($reportType, [
      'PKIMMEUBLE' => $pkImmeuble,
      'DATE' => $date
    ]);

    return $this->responder->respond($output);
  }
}
