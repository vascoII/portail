<?php

declare(strict_types=1);

namespace App\Http\Action\External\Releve;

use App\Application\Factory\Releve\ReleveInputFactory;
use App\Application\UseCase\Releve\GenerateReleveUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/releve/generate', name: 'external_releve_generate', methods: ['POST'])]
final class GenerateReleveAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GenerateReleveUseCase $useCase,
        private readonly ReleveInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->generateReleveFromRequest($request);
        dd($input);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
