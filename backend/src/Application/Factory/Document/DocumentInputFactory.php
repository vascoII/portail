<?php

declare(strict_types=1);

namespace App\Application\Factory\Document;

use App\Application\Dto\Input\Document\GenerateAnomaliesDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateDysfonctionnementsDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateFactureDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateFuitesDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleDetailByImmeubleDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleDetailDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleReleveDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleSyntheseByImmeubleDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateImmeubleSyntheseDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateInterventionDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateInterventionsDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateLogementRepartDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantNoteDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantReleveDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateOccupantRepartDocumentInputDto;
use App\Application\Dto\Input\Document\GenerateReportByTokenDocumentInputDto;
use Symfony\Component\HttpFoundation\Request;

final class DocumentInputFactory
{
    private array $data;

    public function createAnomaliesFromRequest(Request $request): GenerateAnomaliesDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $idLogement = $this->getInt('idLogement', null);
        $idOccupant = $this->getInt('idOccupant', null);
        $idAppareil = $this->getInt('idAppareil', null);

        return new GenerateAnomaliesDocumentInputDto($idImmeuble, $idLogement, $idOccupant, $idAppareil);
    }

    public function createDysfonctionnementsFromRequest(Request $request): GenerateDysfonctionnementsDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $idLogement = $this->getInt('idLogement', null);
        $idOccupant = $this->getInt('idOccupant', null);

        return new GenerateDysfonctionnementsDocumentInputDto($idImmeuble, $idLogement, $idOccupant);
    }

    public function createFactureFromRequest(Request $request): GenerateFactureDocumentInputDto
    {
        $this->getData($request);

        $idFacture = $this->getInt('idFacture');

        return new GenerateFactureDocumentInputDto($idFacture);
    }

    public function createFuitesFromRequest(Request $request): GenerateFuitesDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $idLogement = $this->getInt('idLogement', null);
        $idOccupant = $this->getInt('idOccupant', null);
        $idAppareil = $this->getInt('idAppareil', null);

        return new GenerateFuitesDocumentInputDto($idImmeuble, $idLogement, $idOccupant, $idAppareil);
    }

    public function createImmeubleDetailFromRequest(Request $request): GenerateImmeubleDetailByImmeubleDocumentInputDto|GenerateImmeubleDetailDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $date1 = $this->getString('date1');
        $date2 = $this->getString('date2');

        return is_null($idImmeuble)
            ? new GenerateImmeubleDetailDocumentInputDto((string) $date1, (string) $date2)
            : new GenerateImmeubleDetailByImmeubleDocumentInputDto((int) $idImmeuble, (string) $date1, (string) $date2);
    }

    public function createImmeubleInterventionsFromRequest(Request $request): GenerateInterventionsDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $idLogement = $this->getInt('idLogement', null);
        $idOccupant = $this->getInt('idOccupant', null);

        return new GenerateInterventionsDocumentInputDto($idImmeuble, $idLogement, $idOccupant, null, null);
    }

    public function createImmeubleReleveFromRequest(Request $request): GenerateImmeubleReleveDocumentInputDto
    {
        $this->getData($request);

        $idReleve = $this->getInt('idReleve');

        return new GenerateImmeubleReleveDocumentInputDto($idReleve);
    }

    public function createImmeubleSyntheseFromRequest(Request $request): GenerateImmeubleSyntheseByImmeubleDocumentInputDto|GenerateImmeubleSyntheseDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $date1 = $this->getString('date1');
        $date2 = $this->getString('date2');

        return is_null($idImmeuble)
            ? new GenerateImmeubleSyntheseDocumentInputDto((string) $date1, (string) $date2)
            : new GenerateImmeubleSyntheseByImmeubleDocumentInputDto($idImmeuble, (string) $date1, (string) $date2);
    }

    public function createInterventionFromRequest(Request $request): GenerateInterventionDocumentInputDto
    {
        $this->getData($request);

        $idWorkOrder = $this->getInt('idWorkOrder');

        return new GenerateInterventionDocumentInputDto(
            (string) $idWorkOrder
        );
    }

    public function createInterventionsFromRequest(Request $request): GenerateInterventionsDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $date1 = $this->getString('date1', null);
        $date2 = $this->getString('date2', null);

        return new GenerateInterventionsDocumentInputDto(
            $idImmeuble,
            null,
            null,
            (string) $date1,
            (string) $date2
        );
    }

    public function createLogementRepartFromRequest(Request $request): GenerateLogementRepartDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $idLogement = $this->getInt('idLogement');

        return new GenerateLogementRepartDocumentInputDto($idImmeuble, $idLogement);
    }

    public function createOccupantNoteFromRequest(Request $request): GenerateOccupantNoteDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $idOccupant = $this->getInt('idOccupant');
        $typeErc = $this->getString('typeErc');

        return new GenerateOccupantNoteDocumentInputDto($idOccupant, $idImmeuble, (string) $typeErc);
    }

    public function createOccupantReleveFromRequest(Request $request): GenerateOccupantReleveDocumentInputDto
    {
        $this->getData($request);

        $idOccupant = $this->getInt('idOccupant');

        return new GenerateOccupantReleveDocumentInputDto($idOccupant);
    }

    public function createOccupantRepartFromRequest(Request $request): GenerateOccupantRepartDocumentInputDto
    {
        $this->getData($request);

        $idImmeuble = $this->getInt('idImmeuble');
        $idOccupant = $this->getInt('idOccupant');

        return new GenerateOccupantRepartDocumentInputDto($idImmeuble, $idOccupant);
    }

    public function createReportByTokenFromRequest(Request $request): GenerateReportByTokenDocumentInputDto
    {
        return new GenerateReportByTokenDocumentInputDto(
            (string) $request->attributes->get('tokenId')
        );
    }

    private function getData(Request $request): void
    {
        $raw = (string) $request->getContent();
        $this->data = json_decode($raw, true);

        if (! is_array($this->data)) {
            $this->data = [];
        }
    }

    private function getInt(string $key): ?int
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? (int) $this->data[$key]
            : null;
    }

    private function getString(string $key): string
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? (string) $this->data[$key]
            : '';
    }
}
