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
#[Route(path: '/document/occupant/{pkOccupant}/repart/pdf', name: 'document_occupant_repart_pdf', methods: ['POST'])]
final class GenerateOccupantRepartPdfAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateDocumentPdfUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkOccupant = $request->attributes->get('pkOccupant');
    $pkImmeuble = $request->query->get('pkImmeuble', '');

    $output = $this->useCase->execute('REPART_OCCUPANT', [
      'PKIMMEUBLE' => $pkImmeuble,
      'PKOCCUPANT' => $pkOccupant
    ]);

    return $this->responder->respond($output);
  }
}
