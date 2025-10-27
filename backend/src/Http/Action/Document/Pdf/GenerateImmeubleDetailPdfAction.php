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
#[Route(path: '/document/immeuble/{pkImmeuble}/detail/pdf', name: 'document_immeuble_detail_pdf', methods: ['POST'])]
final class GenerateImmeubleDetailPdfAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateDocumentPdfUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = $request->attributes->get('pkImmeuble');
    $date1 = $request->query->get('date1', '');
    $date2 = $request->query->get('date2', '');

    $output = $this->useCase->execute('LIVRET_INTER_DETAIL', [
      'PKIMMEUBLE' => $pkImmeuble,
      'DATE1' => $date1,
      'DATE2' => $date2
    ]);

    return $this->responder->respond($output);
  }
}
