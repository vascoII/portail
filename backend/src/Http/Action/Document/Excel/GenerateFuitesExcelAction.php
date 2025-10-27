<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Excel;

use App\Application\UseCase\Document\GenerateDocumentExcelUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/document/fuites/excel', name: 'document_fuites_excel', methods: ['POST'])]
final class GenerateFuitesExcelAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly GenerateDocumentExcelUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $pkImmeuble = $request->query->get('pkImmeuble', '');
    $pkLogement = $request->query->get('pkLogement');
    $pkOccupant = $request->query->get('pkOccupant');
    $pkAppareil = $request->query->get('pkAppareil');

    $params = ['PKIMMEUBLE' => $pkImmeuble];
    if ($pkLogement) $params['PKLOGEMENT'] = $pkLogement;
    if ($pkOccupant) $params['PKOCCUPANT'] = $pkOccupant;
    if ($pkAppareil) $params['PKAPPAREIL'] = $pkAppareil;

    $output = $this->useCase->execute('GetInfosFuitesByImmeuble', $params);

    return $this->responder->respond($output);
  }
}
