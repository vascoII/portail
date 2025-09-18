<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Security\LogoutUseCase;
use App\Application\Dto\Input\Security\LogoutInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/logout', name: 'security_logout', methods: ['POST'])]
final class LogoutAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly LogoutUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $input = new LogoutInputDto();
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
