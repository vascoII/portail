<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Pdf;

use App\Application\Factory\Document\DocumentInputFactory;
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
    private readonly GenerateDocumentPdfUseCase $useCase,
    private readonly DocumentInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createImmeubleReleveFromRequest($request);

    // Déterminer le ReportType selon l'énergie
    $reportType = match ($input->energie) {
      'EAU' => 'RELEVE_EAU_IMMEUBLE',
      'REPART' => 'RELEVE_REPART_IMMEUBLE',
      'CET' => 'RELEVE_CET_IMMEUBLE',
      default => 'RELEVE_EAU_IMMEUBLE'
    };

    $output = $this->useCase->execute($reportType, $input);

    return $this->responder->respond($output);
  }
}
