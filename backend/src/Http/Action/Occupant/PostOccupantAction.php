<?php

declare(strict_types=1);

namespace App\Http\Action\Occupant;

use App\Application\Factory\Occupant\OccupantInputFactory;
use App\Application\UseCase\Occupant\PostOccupantUseCase;
use App\Http\Action\AbstractAction;
use App\Http\Action\ActionInterface;
use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/occupant', name: 'occupant_post', methods: ['POST'])]
final class PostOccupantAction extends AbstractAction implements ActionInterface
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly PostOccupantUseCase $useCase,
        private readonly OccupantInputFactory $inputFactory
    ) {}

    public function __invoke(Request $request, array $args = []): Response
    {
        $input = $this->inputFactory->createPostOccupantFromRequest($request, $args);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
