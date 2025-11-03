<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Excel;

use App\Application\Factory\Document\DocumentInputFactory;
use App\Application\UseCase\Document\GenerateDocumentExcelUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/document/immeuble/interventions/excel', name: 'document_immeuble_interventions_excel', methods: ['POST'])]
#[RequireUserType(['C', 'G'])] // Seuls Client et Gestionnaire
final class GenerateImmeubleInterventionsExcelAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GenerateDocumentExcelUseCase $useCase,
        private readonly DocumentInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createImmeubleInterventionsFromRequest($request);
        $output = $this->useCase->execute('GetInfosDepannagesByImmeuble', $input);

        return $this->responder->respond($output);
    }
}
