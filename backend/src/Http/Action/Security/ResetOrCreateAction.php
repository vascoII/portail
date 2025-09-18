<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Security\ResetOrCreateUseCase;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/reset-or-create', name: 'security_reset_or_create', methods: ['POST'])]
final class ResetOrCreateAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ResetOrCreateUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new ResetOrCreateInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
