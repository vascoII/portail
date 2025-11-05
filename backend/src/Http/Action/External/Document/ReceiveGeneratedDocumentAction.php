<?php

declare(strict_types=1);

namespace App\Http\Action\External\Document;

use App\Http\Responder\ResponderInterface;
use App\Application\Factory\Document\DocumentInputFactory;
use App\Application\UseCase\External\GetDocumentGeneratedUseCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
#[Route(path: '/document/receive', name: 'external_document_receive_pdf', methods: ['POST'])]
final class ReceiveGeneratedDocumentAction
{
    public function __construct(
        private readonly ResponderInterface $responder,
        private readonly GetDocumentGeneratedUseCase $useCase,
        private readonly DocumentInputFactory $inputFactory 
    ) {}

    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        if (! is_array($data) || ! isset($data['id']) || ! isset($data['content'])) {
            return new JsonResponse(['error' => 'Invalid payload'], Response::HTTP_BAD_REQUEST);
        }

        $input = $this->inputFactory->createDocumentContentFromRequest($request);
        $output = $this->useCase->execute($input);

        return $this->responder->respond($output);
    }
}
