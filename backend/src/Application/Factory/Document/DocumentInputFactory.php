<?php

declare(strict_types=1);

namespace App\Application\Factory\Document;

use Symfony\Component\HttpFoundation\Request;
use App\Application\Dto\Input\Document\GenerateFactureDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateInterventionDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleReleveDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleSyntheseDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleDetailDocumentInputDto;
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
  public function createFactureFromRequest(Request $request): GenerateFactureDocumentInputDto
  {
    return new GenerateFactureDocumentInputDto(
      (string) $request->attributes->get('pkFacture')
    );
  }

  public function createInterventionFromRequest(Request $request): GenerateInterventionDocumentInputDto
  {
    return new GenerateInterventionDocumentInputDto(
      (string) $request->attributes->get('workOrderNumber')
    );
  }

  public function createImmeubleReleveFromRequest(Request $request): GenerateImmeubleReleveDocumentInputDto
  {
    return new GenerateImmeubleReleveDocumentInputDto(
      (string) $request->attributes->get('pkImmeuble'),
      (string) $request->query->get('date', ''),
      (string) $request->query->get('energie', 'EAU')
    );
  }

  public function createImmeubleSyntheseFromRequest(Request $request): GenerateImmeubleSyntheseDocumentInputDto
  {
    return new GenerateImmeubleSyntheseDocumentInputDto(
      $request->query->get('pkImmeuble'),
      $request->query->get('pkUser'),
      (string) $request->query->get('date1', ''),
      (string) $request->query->get('date2', '')
    );
  }

  public function createImmeubleDetailFromRequest(Request $request): GenerateImmeubleDetailDocumentInputDto
  {
    return new GenerateImmeubleDetailDocumentInputDto(
      (string) $request->attributes->get('pkImmeuble'),
      (string) $request->query->get('date1', ''),
      (string) $request->query->get('date2', '')
    );
  }

  public function createLogementRepartFromRequest(Request $request): GenerateLogementRepartDocumentInputDto
  {
    return new GenerateLogementRepartDocumentInputDto(
      (string) $request->query->get('pkImmeuble', ''),
      (string) $request->attributes->get('pkLogement')
    );
  }

  public function createOccupantReleveFromRequest(Request $request): GenerateOccupantReleveDocumentInputDto
  {
    return new GenerateOccupantReleveDocumentInputDto(
      (string) $request->attributes->get('pkOccupant')
    );
  }

  public function createOccupantRepartFromRequest(Request $request): GenerateOccupantRepartDocumentInputDto
  {
    return new GenerateOccupantRepartDocumentInputDto(
      (string) $request->query->get('pkImmeuble', ''),
      (string) $request->attributes->get('pkOccupant')
    );
  }

  public function createOccupantNoteFromRequest(Request $request): GenerateOccupantNoteDocumentInputDto
  {
    return new GenerateOccupantNoteDocumentInputDto(
      (string) $request->attributes->get('pkOccupant'),
      (string) $request->query->get('pkImmeuble', ''),
      $request->query->get('typeEnergie')
    );
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
}
