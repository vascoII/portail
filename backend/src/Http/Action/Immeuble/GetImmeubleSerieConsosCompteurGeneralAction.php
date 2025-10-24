<?php

declare(strict_types=1);

namespace App\Http\Action\Immeuble;

use App\Application\Factory\Shared\SharedInputFactory;
use App\Application\UseCase\Immeuble\GetImmeubleSerieConsosCompteurGeneralUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/immeuble_serie_consos_compteur_general/{id}', name: 'immeuble_serie_comsos_compteur_general_get', methods: ['GET'])]
final class GetImmeubleSerieConsosCompteurGeneralAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GetImmeubleSerieConsosCompteurGeneralUseCase $useCase,
        private readonly SharedInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->getIdIntFromRoute($request);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
