<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

//use App\Application\Factory\Security\SecurityInputFactory;
//use App\Application\UseCase\Security\LoginUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

use App\Application\Dto\Output\Security\LoginOutputDto;

#[AsController]
#[Route(path: '/security/login', name: 'security_login', methods: ['POST'])]
final class LoginAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        //private readonly ?LoginUseCase $useCase = null,
        //private readonly ?SecurityInputFactory $inputFactory = null
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        // Trick: bypass real use case and return fake data for development
        // $input = $this->inputFactory->createLoginFromRequest($request);
        // $output = $this->useCase->execute($input);

        $output = new LoginOutputDto(
            tokenJwt: "npA",
            loginId: "TESTCLIENTCOMPLET",
            userName: "TEST CLIENT Complet",
            email: "noreply@techem.fr",
            userType: "C",
            adresse: "",
            cp: "",
            ville: "",
            phoneNumber: "",
            firstName: "Client",
            userRole: "",
            clientName: "",
            nbImmeubles: -1,
            seuilConsoEf: -1,
            seuilConsoEc: -1,
            seuilConsoRepart: -1,
            seuilConsoCet: -1,
            seuilConsoActif: false,
            seuilConsoEmail: "",
            showImmeublesArc: true,
            showFactures: true,
            showChgtOccupant: true,
            showChantiers: true
        );
        return $this->responder->respond($output);
    }
}
