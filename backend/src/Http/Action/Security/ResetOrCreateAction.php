<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Application\UseCase\Security\ResetOrCreateUseCase;
use App\Application\Factory\Security\SecurityInputFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[Route(path: '/security/reset-or-create', name: 'security_reset_or_create', methods: ['POST'])]
final class ResetOrCreateAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly ResetOrCreateUseCase $useCase,
    private readonly SecurityInputFactory $inputFactory
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = $this->inputFactory->createResetOrCreateFromRequest($request);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
