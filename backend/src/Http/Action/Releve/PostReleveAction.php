<?php

declare(strict_types=1);

namespace App\Http\Action\Releve;

use App\Application\Factory\Releve\ReleveInputFactory;
use App\Application\UseCase\Releve\PostReleveUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/releve', name: 'releve_post', methods: ['POST'])]
final class PostReleveAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly PostReleveUseCase $useCase,
        private readonly ReleveInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createPostReleveFromRequest($request, $args);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
