<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Application\Factory\Shared\SharedInputFactory;
use App\Application\UseCase\Immeuble\ListDysfonctionnementsByImmeubleUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/immeuble/{immeubleId}/dysfonctionnements', name: 'immeuble_dysfonctionnements_list', methods: ['GET'])]
#[RequireUserType(['C', 'G'])] // Seuls Client et Gestionnaire
final class ListDysfonctionnementsByImmeubleAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly ListDysfonctionnementsByImmeubleUseCase $useCase,
        private readonly SharedInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->getIdIntFromRoute($request);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
