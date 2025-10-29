<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Pdf;

use App\Application\Factory\Document\DocumentInputFactory;
use App\Application\UseCase\Document\GenerateDocumentPdfUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/document/occupant/releve/pdf', name: 'document_occupant_releve_pdf', methods: ['POST'])]
#[RequireUserType(['O'])] // Seuls les Occupants
final class GenerateOccupantRelevePdfAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GenerateDocumentPdfUseCase $useCase,
        private readonly DocumentInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createOccupantReleveFromRequest($request);
        $output = $this->useCase->execute('RELEVE_OCCUPANT', $input);

        return $this->responder->respond($output);
    }
}
