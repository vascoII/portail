<?php

declare(strict_types=1);

namespace App\Http\Action\Intervention;

use App\Application\Factory\Intervention\InterventionInputFactory;
use App\Application\UseCase\Intervention\GetCasesByEmailUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/interventions', name: 'get_cases', methods: ['POST'])]
final class GetCasesByEmailAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GetCasesByEmailUseCase $useCase,
        private readonly InterventionInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createGetCasesByEmailFromRequest($request, $args);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
