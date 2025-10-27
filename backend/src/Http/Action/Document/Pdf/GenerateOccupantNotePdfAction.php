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
#[Route(path: '/document/occupant/{pkOccupant}/note/pdf', name: 'document_occupant_note_pdf', methods: ['POST'])]
final class GenerateOccupantNotePdfAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateDocumentPdfUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkOccupant = $request->attributes->get('pkOccupant');
    $pkImmeuble = $request->query->get('pkImmeuble', '');
    $typeEnergie = $request->query->get('typeEnergie', 'EAU'); // EAU ou CHAUFFAGE

    $output = $this->useCase->execute('NOTE_INFO_MENSUELLE', [
      'PKOCCUPANT' => $pkOccupant,
      'PKIMMEUBLE' => $pkImmeuble,
      'TYPEERC' => $typeEnergie
    ]);

    return $this->responder->respond($output);
  }
}
