<?php

declare(strict_types=1);

namespace App\Http\Action\Parc;

//use App\Application\UseCase\Parc\GetParcUseCase;
use App\Application\Dto\Output\Parc\GetParcOutputDto;
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
        //private readonly GetParcUseCase $useCase
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        //$output = $this->useCase->execute();
        $output = new GetParcOutputDto(
            nbImmeubles: 26,
            nbImmeublesTelereleve: 2,
            nbImmeublesTransfertFichiers: 1,
            nbCompteursARelever: 2571,
            nbCompteursReleves: 2427,
            nbLogements: 1505,
            nbCompteurs: 2744,
            nbCompteursEc: 1403,
            nbCompteursEf: 1341,
            nbCompteursRepart: 0,
            nbCompteursCet: 0,
            nbCompteursCapteur: 0,
            nbCompteursElect: -1,
            nbCompteursGaz: -1,
            nbFuites: 12,
            degresFuites: -1,
            nbDepannages: 0,
            degresDepannages: -1,
            nbDysfonctionnements: 0,
            degresDysfonctionnements: -1,
            nbAnomalies: 171,
            degresAnomalies: -1,
            nbChantiers: 0,
            nbCompteursPoses: 0,
            nbCompteursCommandes: 0,
            pcImmeublesTelereleve: 94,
            pcImmeublesTransfertFichiers: 4
        );
        return $this->responder->respond($output);
    }
}
