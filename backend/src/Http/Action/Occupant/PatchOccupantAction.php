<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Application\Factory\Occupant\OccupantInputFactory;
use App\Application\UseCase\Occupant\PatchOccupantUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/occupant/{id}', name: 'occupant_patch', methods: ['PATCH'])]
final class PatchOccupantAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly PatchOccupantUseCase $useCase,
        private readonly OccupantInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createPatchOccupantFromRequest($request, $args);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
