<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Application\UseCase\Occupant\GetOccupantReleveEauUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/occupant/releve_eau', name: 'occupant_releve_eau', methods: ['GET'])]
final class GetOccupantReleveEauAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GetOccupantReleveEauUseCase $useCase
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $output = $this->useCase->execute();

        return $this->responder->respond($output);
    }
}
