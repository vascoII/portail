<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * Class ExternalService
 * @package App\Service
 */
class ExternalService
{
  private $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  /**
   * Récupère la liste des documents par email et pkUser
   *
   * @param string $email
   * @param int $pkUser
   * @return array
   * @throws \Exception
   */
  public function getDocumentsByEmail(string $email, int $pkUser): array
  {
    try {
      // Appel du service SOAP pour récupérer les documents
      $result = $this->client->getDocumentsByEmail($email, $pkUser);

      // Simulation de données pour le développement
      // À remplacer par le vrai appel SOAP
      return $this->simulateDocumentsData();
    } catch (\Exception $e) {
      throw new RuntimeException('Erreur lors de la récupération des documents : ' . $e->getMessage());
    }
  }

  /**
   * Génère le PDF d'un document
   *
   * @param int $documentId
   * @return string
   * @throws \Exception
   */
  public function generateDocumentPdf(int $documentId): string
  {
    try {
      // Appel du service SOAP pour générer le PDF
      $result = $this->client->generateDocumentPdf($documentId);

      // Simulation de contenu PDF pour le développement
      // À remplacer par le vrai appel SOAP
      return $this->simulatePdfContent($documentId);
    } catch (\Exception $e) {
      throw new RuntimeException('Erreur lors de la génération du PDF : ' . $e->getMessage());
    }
  }

  /**
   * Simule des données de documents pour le développement
   * À remplacer par les vraies données SOAP
   */
  private function simulateDocumentsData(): array
  {
    return [
      [
        'id' => 1,
        'title' => 'Rapport d\'intervention - Chauffage',
        'date' => '2024-01-15',
        'type' => 'Intervention',
        'description' => 'Maintenance préventive du système de chauffage',
        'status' => 'Terminé',
        'technician' => 'Jean Dupont',
        'duration' => '2h30',
        'location' => 'Appartement 15 - 3ème étage',
      ],
      [
        'id' => 2,
        'title' => 'Rapport d\'intervention - Plomberie',
        'date' => '2024-01-20',
        'type' => 'Intervention',
        'description' => 'Réparation de la fuite d\'eau dans la salle de bain',
        'status' => 'Terminé',
        'technician' => 'Marie Martin',
        'duration' => '1h45',
        'location' => 'Appartement 15 - 3ème étage',
      ],
      [
        'id' => 3,
        'title' => 'Rapport d\'intervention - Électricité',
        'date' => '2024-01-25',
        'type' => 'Intervention',
        'description' => 'Remplacement d\'un interrupteur défaillant',
        'status' => 'En cours',
        'technician' => 'Pierre Durand',
        'duration' => '0h45',
        'location' => 'Appartement 15 - 3ème étage',
      ],
    ];
  }

  /**
   * Simule le contenu PDF pour le développement
   * À remplacer par le vrai contenu PDF généré par SOAP
   */
  private function simulatePdfContent(int $documentId): string
  {
    // Simulation d'un contenu PDF simple
    $content = "%PDF-1.4\n";
    $content .= "1 0 obj\n";
    $content .= "<<\n";
    $content .= "/Type /Catalog\n";
    $content .= "/Pages 2 0 R\n";
    $content .= ">>\n";
    $content .= "endobj\n";
    $content .= "2 0 obj\n";
    $content .= "<<\n";
    $content .= "/Type /Pages\n";
    $content .= "/Kids [3 0 R]\n";
    $content .= "/Count 1\n";
    $content .= ">>\n";
    $content .= "endobj\n";
    $content .= "3 0 obj\n";
    $content .= "<<\n";
    $content .= "/Type /Page\n";
    $content .= "/Parent 2 0 R\n";
    $content .= "/MediaBox [0 0 612 792]\n";
    $content .= "/Contents 4 0 R\n";
    $content .= ">>\n";
    $content .= "endobj\n";
    $content .= "4 0 obj\n";
    $content .= "<<\n";
    $content .= "/Length 100\n";
    $content .= ">>\n";
    $content .= "stream\n";
    $content .= "BT\n";
    $content .= "/F1 12 Tf\n";
    $content .= "72 720 Td\n";
    $content .= "(Document d'intervention #" . $documentId . ") Tj\n";
    $content .= "ET\n";
    $content .= "endstream\n";
    $content .= "endobj\n";
    $content .= "xref\n";
    $content .= "0 5\n";
    $content .= "0000000000 65535 f \n";
    $content .= "0000000009 00000 n \n";
    $content .= "0000000058 00000 n \n";
    $content .= "0000000115 00000 n \n";
    $content .= "0000000274 00000 n \n";
    $content .= "trailer\n";
    $content .= "<<\n";
    $content .= "/Size 5\n";
    $content .= "/Root 1 0 R\n";
    $content .= ">>\n";
    $content .= "startxref\n";
    $content .= "424\n";
    $content .= "%%EOF\n";

    return $content;
  }
}
