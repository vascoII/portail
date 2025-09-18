<?php

declare(strict_types=1);

namespace App\Http\Action\Security;

use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use App\Domain\UseCase\Security\LoginFromParamUseCase;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/security/login/param', name: 'security_login_param', methods: ['GET'])]
final class LoginFromParamAction extends AbstractAction implements ActionInterface
{
  public function __construct(private readonly ResponderInterface $responder, private readonly LoginFromParamUseCase $useCase) {}

  public function __invoke(Request $request, array $args = []): Response
  {
    $username = (string) $request->query->get('username', '');
    $password = (string) $request->query->get('password', '');
    $input = new LoginFromParamInputDto($username, $password);
    $output = $this->useCase->execute($input);
    return $this->responder->respond($output);
  }
}
