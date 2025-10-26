<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Application\UseCase\Security\PatchCguUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Attribute\RequireUserType;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/security/patch-cgu', name: 'security_patch_cgu', methods: ['PATCH'])]
#[RequireUserType(['C', 'G', 'O'])]
final class PatchCguAction extends AbstractAction implements ActionInterface
{
  public function __construct(
    private readonly ResponderInterface $responder,
    private readonly PatchCguUseCase $useCase
  ) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $output = $this->useCase->execute();

    return $this->responder->respond($output);
  }
}
