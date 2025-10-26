<?php

declare(strict_types=1);

namespace App\Http\Action\Parc;

use App\Application\UseCase\Parc\GetParcUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/parc', name: 'parc_get', methods: ['GET'])]
#[RequireUserType(['C', 'G'])] // Seuls Client et Gestionnaire
final class GetParcAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GetParcUseCase $useCase
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $output = $this->useCase->execute();

        return $this->responder->respond($output);
    }
}
