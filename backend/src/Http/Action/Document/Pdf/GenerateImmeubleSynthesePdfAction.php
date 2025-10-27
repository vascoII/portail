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
#[Route(path: '/document/immeuble/synthese/pdf', name: 'document_immeuble_synthese_pdf', methods: ['POST'])]
final class GenerateImmeubleSynthesePdfAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateDocumentPdfUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = $request->query->get('pkImmeuble');
    $pkUser = $request->query->get('pkUser');
    $date1 = $request->query->get('date1', '');
    $date2 = $request->query->get('date2', '');

    $params = ['DATE1' => $date1, 'DATE2' => $date2];
    if ($pkImmeuble) {
      $params['PKIMMEUBLE'] = $pkImmeuble;
    } elseif ($pkUser) {
      $params['PKUSER'] = $pkUser;
    }

    $output = $this->useCase->execute('LIVRET_INTER_SYNTHESE', $params);

    return $this->responder->respond($output);
  }
}
