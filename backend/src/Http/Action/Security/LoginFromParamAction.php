<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Application\Factory\Security\SecurityInputFactory;
use App\Application\UseCase\Security\LoginFromParamUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/security/login/param', name: 'security_login_param', methods: ['POST'])]
final class LoginFromParamAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly LoginFromParamUseCase $useCase,
        private readonly SecurityInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createLoginFromParamFromRequest($request);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
