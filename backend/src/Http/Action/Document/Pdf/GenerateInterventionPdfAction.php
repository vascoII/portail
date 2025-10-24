<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Pdf;

use App\Application\Factory\Shared\SharedInputFactory;
use App\Application\UseCase\Document\GenerateInterventionPdfUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/document/intervention/{pkIntervention}/generate', name: 'intervention_generate', methods: ['GET'])]
final class GenerateInterventionPdfAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GenerateInterventionPdfUseCase $useCase,
        private readonly SharedInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createGetReportFromRouteWithCustomParams($request, self::INTERVENTION, self::PARAM_PK_INTERVENTION, 'WORKORDERNUMBER');
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
