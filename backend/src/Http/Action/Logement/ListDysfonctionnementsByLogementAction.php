<?php

declare(strict_types=1);

namespace App\Http\Action\Logement;

use App\Application\Factory\Logement\LogementInputFactory;
use App\Application\UseCase\Logement\ListDysfonctionnementsByLogementUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/immeuble/{pkImmeuble}/logement/{pkLogement}/dysfonctionnements', name: 'logement_dysfonctionnements_list', methods: ['GET'])]
#[RequireUserType(['C', 'G'])] // Seuls Client et Gestionnaire
final class ListDysfonctionnementsByLogementAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly ListDysfonctionnementsByLogementUseCase $useCase,
        private readonly LogementInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->getImmeubleIdAndLogementIdFromRoute($request);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
