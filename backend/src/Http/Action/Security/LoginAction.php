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
            tokenJwt: "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ0ZWNoZW0tcG9ydGFpbCIsImF1ZCI6InRlY2hlbS1jbGllbnQiLCJpYXQiOjE3NjE3NDI4MDQsImV4cCI6MTc2MTc0NjQwNCwic3ViIjoiNzkyMjIiLCJkYXRhIjp7InNlc3Npb25JZCI6ImI0Y2NhODA3LWQ3MmQtNGE2ZS1hYzViLWNhNGU1YjhiYTk2ZiIsInVzZXJOYW1lIjoiVEVTVCBDTElFTlQgQ29tcGxldCIsImxvZ2luSWQiOiJURVNUQ0xJRU5UQ09NUExFVCIsInVzZXJUeXBlIjoiQyIsImNsaWVudElkIjoiQzAwMzgzIiwiZmtDbGllbnQiOjM3NzE4LCJ1c2VyUm9sZSI6IiJ9fQ._Aw1A7xdqoiMjY0qY_9WKF57YXANTdVJu1zI60bVnpA",
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
