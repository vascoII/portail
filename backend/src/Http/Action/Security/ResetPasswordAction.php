<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Security\ResetPasswordUseCase;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/reset-password', name: 'reset_password', methods: ['POST'])]
final class ResetPasswordAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly ResetPasswordUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new ResetPasswordInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
