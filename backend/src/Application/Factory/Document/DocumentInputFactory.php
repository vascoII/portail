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
use App\Application\Dto\Input\Document\GenerateReportDocumentInputDto;
use Symfony\Component\HttpFoundation\Request;

final class DocumentInputFactory
{
    private array $data;

    public function createAnomaliesFromRequest(Request $request): GenerateAnomaliesDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);
        $appareilId = $this->getInt('appareilId', null);

        return new GenerateAnomaliesDocumentInputDto($immeubleId, $logementId, $occupantId, $appareilId);
    }

    public function createDysfonctionnementsFromRequest(Request $request): GenerateDysfonctionnementsDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);

        return new GenerateDysfonctionnementsDocumentInputDto($immeubleId, $logementId, $occupantId);
    }

    public function createFactureFromRequest(Request $request): GenerateFactureDocumentInputDto
    {
        $this->getData($request);

        $factureId = $this->getInt('factureId');

        return new GenerateFactureDocumentInputDto($factureId);
    }

    public function createFuitesFromRequest(Request $request): GenerateFuitesDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);
        $appareilId = $this->getInt('appareilId', null);

        return new GenerateFuitesDocumentInputDto($immeubleId, $logementId, $occupantId, $appareilId);
    }

    public function createImmeubleDetailFromRequest(Request $request): GenerateImmeubleDetailByImmeubleDocumentInputDto|GenerateImmeubleDetailDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $date1 = $this->getString('date1');
        $date2 = $this->getString('date2');

        return is_null($immeubleId)
            ? new GenerateImmeubleDetailDocumentInputDto((string) $date1, (string) $date2)
            : new GenerateImmeubleDetailByImmeubleDocumentInputDto((int) $immeubleId, (string) $date1, (string) $date2);
    }

    public function createImmeubleInterventionsFromRequest(Request $request): GenerateInterventionsDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId', null);
        $occupantId = $this->getInt('occupantId', null);

        return new GenerateInterventionsDocumentInputDto($immeubleId, $logementId, $occupantId, null, null);
    }

    public function createImmeubleReleveFromRequest(Request $request): GenerateImmeubleReleveDocumentInputDto
    {
        $this->getData($request);

        $releveId = $this->getInt('releveId');

        return new GenerateImmeubleReleveDocumentInputDto($releveId);
    }

    public function createImmeubleSyntheseFromRequest(Request $request): GenerateImmeubleSyntheseByImmeubleDocumentInputDto|GenerateImmeubleSyntheseDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $date1 = $this->getString('date1');
        $date2 = $this->getString('date2');

        return is_null($immeubleId)
            ? new GenerateImmeubleSyntheseDocumentInputDto((string) $date1, (string) $date2)
            : new GenerateImmeubleSyntheseByImmeubleDocumentInputDto($immeubleId, (string) $date1, (string) $date2);
    }

    public function createInterventionFromRequest(Request $request): GenerateInterventionDocumentInputDto
    {
        $this->getData($request);

        $workOrderId = $this->getInt('workOrderId');

        return new GenerateInterventionDocumentInputDto(
            (string) $workOrderId
        );
    }

    public function createInterventionsFromRequest(Request $request): GenerateInterventionsDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $date1 = $this->getString('date1', null);
        $date2 = $this->getString('date2', null);

        return new GenerateInterventionsDocumentInputDto(
            $immeubleId,
            null,
            null,
            (string) $date1,
            (string) $date2
        );
    }

    public function createLogementRepartFromRequest(Request $request): GenerateLogementRepartDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $logementId = $this->getInt('logementId');

        return new GenerateLogementRepartDocumentInputDto($immeubleId, $logementId);
    }

    public function createOccupantNoteFromRequest(Request $request): GenerateOccupantNoteDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $occupantId = $this->getInt('occupantId');
        $typeErc = $this->getString('typeErc');

        return new GenerateOccupantNoteDocumentInputDto($occupantId, $immeubleId, (string) $typeErc);
    }

    public function createOccupantReleveFromRequest(Request $request): GenerateOccupantReleveDocumentInputDto
    {
        $this->getData($request);

        $occupantId = $this->getInt('occupantId');

        return new GenerateOccupantReleveDocumentInputDto($occupantId);
    }

    public function createOccupantRepartFromRequest(Request $request): GenerateOccupantRepartDocumentInputDto
    {
        $this->getData($request);

        $immeubleId = $this->getInt('immeubleId');
        $occupantId = $this->getInt('occupantId');

        return new GenerateOccupantRepartDocumentInputDto($immeubleId, $occupantId);
    }

    public function createReportByTokenFromRequest(Request $request): GenerateReportByTokenDocumentInputDto
    {
        return new GenerateReportByTokenDocumentInputDto(
            (string) $request->attributes->get('tokenId')
        );
    }

    public function createDocumentContentFromRequest(Request $request): GenerateReportDocumentInputDto
    {
        $this->getData($request);

        $id = $this->getInt('id');
        $content = $this->getContent('content');

        return new GenerateReportDocumentInputDto($id, $content);
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

    private function getContent(mixed $content): mixed
    {
        return array_key_exists($content, $this->data) && null !== $this->data[$content]
            ? $this->data[$content]
            : null;
    }
}
