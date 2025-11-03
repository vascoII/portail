<?php

declare(strict_types=1);

namespace App\Http\Action\External\Document;

use App\Http\Responder\ResponderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;


#[AsController]
#[Route(path: '/document/receive', name: 'external_document_receive_pdf', methods: ['POST'])]
final class ReceiveGeneratedDocumentAction
{
    public function __construct(
        private readonly ResponderInterface $responder
    ) {}

    public function __invoke(Request $request, HubInterface $hub): Response
    {
        $data = json_decode($request->getContent(), true);
        
        if (! is_array($data) || ! isset($data['id']) || ! isset($data['content'])) {
            return new JsonResponse(['error' => 'Invalid payload'], Response::HTTP_BAD_REQUEST);
        }

        // Publier l'événement Mercure
        $documentId = $data['id'];
        $update = new Update(
            "document/{$documentId}",
            json_encode(['status' => 'ready', 'id' => $documentId])
        );

        $hub->publish($update);

        return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
    }
}
