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
#[Route(path: '/document/intervention/pdf', name: 'document_intervention_pdf', methods: ['POST'])]
#[RequireUserType(['C', 'G'])] // Seuls Client et Gestionnaire
final class GenerateInterventionPdfAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GenerateDocumentPdfUseCase $useCase,
        private readonly DocumentInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createInterventionFromRequest($request);
        $output = $this->useCase->execute('CR_INTERVENTION', $input);

        return $this->responder->respond($output);
    }
}
