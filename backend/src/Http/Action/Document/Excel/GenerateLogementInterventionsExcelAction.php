<?php

declare(strict_types=1);

namespace App\Http\Action\Document\Excel;

use App\Application\Factory\Shared\SharedInputFactory;
use App\Application\UseCase\Document\GenerateLogementInterventionsExcelUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/document/interventions_logement/{id}/generate', name: 'interventions_logement_generate', methods: ['GET'])]
final class GenerateLogementInterventionsExcelAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GenerateLogementInterventionsExcelUseCase $useCase,
        private readonly SharedInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createIdStringFromRoute($request);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
