<?php

declare(strict_types=1);

namespace App\Application\Factory\Document;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Document\GenerateFactureDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateReportByTokenDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateInterventionDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleReleveDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleSyntheseDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleSyntheseByImmeubleDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleDetailDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleDetailByImmeubleDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateLogementRepartDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantReleveDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantRepartDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantNoteDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateAnomaliesDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateFuitesDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateInterventionsDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateDysfonctionnementsDocumentInputDto;

final class DocumentInputFactory
{
  private array $data;

  public function createFactureFromRequest(Request $request): GenerateFactureDocumentInputDto
  {
    $this->getData($request); 

    $idFacture = $this->getInt('idFacture');

    return new GenerateFactureDocumentInputDto(
      (string) $idFacture
    );
  }

  public function createReportByTokenFromRequest(Request $request): GenerateReportByTokenDocumentInputDto
  {
    return new GenerateReportByTokenDocumentInputDto(
      (string) $request->attributes->get('tokenId')
    );
  }

  public function createInterventionFromRequest(Request $request): GenerateInterventionDocumentInputDto
  {
    $this->getData($request); 

    $idWorkOrder = $this->getInt('idWorkOrder');
    return new GenerateInterventionDocumentInputDto(
      (string) $idWorkOrder
    );
  }

  public function createImmeubleReleveFromRequest(Request $request): GenerateImmeubleReleveDocumentInputDto
  {
    $this->getData($request); 

    $idImmeuble = $this->getInt('idImmeuble');
    return new GenerateImmeubleReleveDocumentInputDto(
      (string) $idImmeuble
    );
  }

  public function createImmeubleSyntheseFromRequest(Request $request): GenerateImmeubleSyntheseDocumentInputDto|GenerateImmeubleSyntheseByImmeubleDocumentInputDto
  {
    $this->getData($request); 

    $idImmeuble = $this->getInt('idImmeuble');
    $date1 = $this->getString('date1');
    $date2 = $this->getString('date2');

    return is_null($idImmeuble) ?
        new GenerateImmeubleSyntheseDocumentInputDto((string) $date1, (string) $date2) : 
        new GenerateImmeubleSyntheseByImmeubleDocumentInputDto((int) $idImmeuble, (string) $date1, (string) $date2);
  }

  public function createImmeubleDetailFromRequest(Request $request): GenerateImmeubleDetailDocumentInputDto|GenerateImmeubleDetailByImmeubleDocumentInputDto
  {
    $this->getData($request); 

    $idImmeuble = $this->getInt('idImmeuble');
    $date1 = $this->getString('date1');
    $date2 = $this->getString('date2');

    return is_null($idImmeuble) ? 
        new GenerateImmeubleDetailDocumentInputDto((string) $date1, (string) $date2) : 
        new GenerateImmeubleDetailByImmeubleDocumentInputDto((int) $idImmeuble, (string) $date1, (string) $date2);
  }

  public function createLogementRepartFromRequest(Request $request): GenerateLogementRepartDocumentInputDto
  {
    $this->getData($request); 

    $idImmeuble = $this->getInt('idImmeuble');
    $idLogement = $this->getInt('idLogement');

    return new GenerateLogementRepartDocumentInputDto((string) $idImmeuble, (string) $idLogement);
  }

  public function createOccupantReleveFromRequest(Request $request): GenerateOccupantReleveDocumentInputDto
  {
    $this->getData($request); 

    $idOccupant = $this->getInt('idOccupant');
    
    return new GenerateOccupantReleveDocumentInputDto((string) $idOccupant);
  }

  public function createOccupantRepartFromRequest(Request $request): GenerateOccupantRepartDocumentInputDto
  {
    $this->getData($request); 

    $idImmeuble = $this->getInt('idImmeuble');
    $idOccupant = $this->getInt('idOccupant');
    return new GenerateOccupantRepartDocumentInputDto((string) $idImmeuble, (string) $idOccupant);
  }

  public function createOccupantNoteFromRequest(Request $request): GenerateOccupantNoteDocumentInputDto
  {
    $this->getData($request); 

    $idImmeuble = $this->getInt('idImmeuble');
    $idOccupant = $this->getInt('idOccupant');
    $typeErc = $this->getString('typeErc');

    return new GenerateOccupantNoteDocumentInputDto((string) $idOccupant, (string) $idImmeuble, (string) $typeErc);
  }

  public function createAnomaliesFromRequest(Request $request): GenerateAnomaliesDocumentInputDto
  {
    return new GenerateAnomaliesDocumentInputDto(
      (string) $request->query->get('pkImmeuble', ''),
      $request->query->get('pkLogement'),
      $request->query->get('pkOccupant'),
      $request->query->get('pkAppareil')
    );
  }

  public function createFuitesFromRequest(Request $request): GenerateFuitesDocumentInputDto
  {
    return new GenerateFuitesDocumentInputDto(
      (string) $request->query->get('pkImmeuble', ''),
      $request->query->get('pkLogement'),
      $request->query->get('pkOccupant'),
      $request->query->get('pkAppareil')
    );
  }

  public function createInterventionsFromRequest(Request $request): GenerateInterventionsDocumentInputDto
  {
    // When pkImmeuble is in the route
    if ($pkImmeuble = $request->attributes->get('pkImmeuble')) {
      return new GenerateInterventionsDocumentInputDto(
        (string) $pkImmeuble,
        $request->query->get('pkLogement'),
        $request->query->get('pkOccupant')
      );
    }

    // When pkImmeuble is in query params
    return new GenerateInterventionsDocumentInputDto(
      (string) $request->query->get('pkImmeuble', ''),
      $request->query->get('pkLogement'),
      $request->query->get('pkOccupant')
    );
  }

  public function createInterventionsFromRoute(Request $request): GenerateInterventionsDocumentInputDto
  {
    return new GenerateInterventionsDocumentInputDto(
      (string) $request->query->get('pkImmeuble', ''),
      $request->query->get('pkLogement'),
      $request->query->get('pkOccupant')
    );
  }

  public function createDysfonctionnementsFromRequest(Request $request): GenerateDysfonctionnementsDocumentInputDto
  {
    return new GenerateDysfonctionnementsDocumentInputDto(
      (string) $request->query->get('pkImmeuble', ''),
      $request->query->get('pkLogement'),
      $request->query->get('pkOccupant')
    );
  }

  private function getData(Request $request): void
  {
      $raw = (string) $request->getContent();
      $this->data = json_decode($raw, true);

      if (!is_array($this->data)) {
        $this->data = [];
      }
  }

  private function getInt(string $key): ?int
  {
      return array_key_exists($key, $this->data) && $this->data[$key] !== null
          ? (int) $this->data[$key]
          : null;
  }

  private function getString(string $key): string
  {
      return array_key_exists($key, $this->data) && $this->data[$key] !== null
          ? (string) $this->data[$key]
          : '';
  }

}
