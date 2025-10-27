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
#[Route(path: '/document/logement/{pkLogement}/repart/pdf', name: 'document_logement_repart_pdf', methods: ['POST'])]
final class GenerateLogementRepartPdfAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateDocumentPdfUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkLogement = $request->attributes->get('pkLogement');
    $pkImmeuble = $request->query->get('pkImmeuble', '');

    $output = $this->useCase->execute('REPART_LOGEMENT', [
      'PKIMMEUBLE' => $pkImmeuble,
      'PKLOGEMENT' => $pkLogement
    ]);

    return $this->responder->respond($output);
  }
}
