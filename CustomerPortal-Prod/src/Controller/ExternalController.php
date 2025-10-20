<?php

namespace App\Controller;

use App\Form\ExternalFormType;
use App\Service\ExternalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExternalController
 * @package App\Controller
 */
class ExternalController extends AbstractController
{
  private $externalService;

  public function __construct(ExternalService $externalService)
  {
    $this->externalService = $externalService;
  }

  /**
   * Affiche le formulaire d'email pour accéder aux interventions
   */
  #[Route('/interventions/{pkUser}', name: 'external_interventions_form', methods: ['GET', 'POST'])]
  public function interventionsForm(Request $request, SessionInterface $session, int $pkUser): Response
  {
    $form = $this->createForm(ExternalFormType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $email = $form->get('email')->getData();

      try {
        // Appel du service SOAP pour récupérer les documents
        $documents = $this->externalService->getDocumentsByEmail($email, $pkUser);

        // Enregistrement en session
        $session->set('external_documents', $documents);
        $session->set('external_pk_user', $pkUser);

        return $this->redirectToRoute('external_interventions_list');
      } catch (\Exception $e) {
        $this->addFlash('error', 'Erreur lors de la récupération des documents : ' . $e->getMessage());
      }
    }

    return $this->render('External/interventions_form.html.twig', [
      'form' => $form->createView(),
      'pkUser' => $pkUser,
    ]);
  }

  /**
   * Affiche la liste des documents
   */
  #[Route('/interventions/list', name: 'external_interventions_list', methods: ['GET'])]
  public function interventionsList(SessionInterface $session): Response
  {
    $documents = $session->get('external_documents', []);

    if (empty($documents)) {
      $this->addFlash('warning', 'Aucun document trouvé.');
      return $this->redirectToRoute('external_interventions_form', ['pkUser' => $session->get('external_pk_user', 1)]);
    }

    return $this->render('External/interventions_list.html.twig', [
      'documents' => $documents,
    ]);
  }

  /**
   * Affiche les détails d'un document
   */
  #[Route('/interventions/details/{id}', name: 'external_interventions_details', methods: ['GET'])]
  public function interventionsDetails(SessionInterface $session, int $id): Response
  {
    $documents = $session->get('external_documents', []);

    // Recherche du document par ID
    $document = null;
    foreach ($documents as $doc) {
      if ($doc['id'] == $id) {
        $document = $doc;
        break;
      }
    }

    if (!$document) {
      throw $this->createNotFoundException('Document non trouvé.');
    }

    return $this->render('External/interventions_details.html.twig', [
      'document' => $document,
    ]);
  }

  /**
   * Télécharge un document PDF
   */
  #[Route('/interventions/download/{id}', name: 'external_interventions_download', methods: ['GET'])]
  public function downloadDocument(SessionInterface $session, int $id): Response
  {
    $documents = $session->get('external_documents', []);

    // Recherche du document par ID
    $document = null;
    foreach ($documents as $doc) {
      if ($doc['id'] == $id) {
        $document = $doc;
        break;
      }
    }

    if (!$document) {
      throw $this->createNotFoundException('Document non trouvé.');
    }

    try {
      // Appel du service SOAP pour générer le PDF
      $pdfContent = $this->externalService->generateDocumentPdf($id);

      $response = new Response($pdfContent);
      $response->headers->set('Content-Type', 'application/pdf');
      $response->headers->set('Content-Disposition', 'inline; filename=document-' . $id . '.pdf');
      $response->headers->set('Content-Transfer-Encoding', 'binary');
      $response->headers->set('Expires', 0);
      $response->headers->set('Cache-Control', 'no-cache');
      $response->headers->set('Pragma', 'no-cache');
      $response->headers->set('Content-Length', strlen($pdfContent));

      return $response;
    } catch (\Exception $e) {
      $this->addFlash('error', 'Erreur lors de la génération du PDF : ' . $e->getMessage());
      return $this->redirectToRoute('external_interventions_list');
    }
  }
}
