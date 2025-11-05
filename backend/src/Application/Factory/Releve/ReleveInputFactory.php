<?php

declare(strict_types=1);

namespace App\Application\Factory\Releve;

use App\Application\Dto\Input\Releve\GenerateReleveInputDto;
use App\Application\Dto\Input\Releve\ReleveCompteursDto;
use App\Application\Validator\Input\Releve\GenerateReleveInputValidator;
use Symfony\Component\HttpFoundation\Request;

final class ReleveInputFactory
{
    private array $data;

    public function __construct(
        private GenerateReleveInputValidator $validator
    ) {}

    public function generateReleveFromRequest(Request $request): GenerateReleveInputDto
    {
        $this->getData($request);

        $numeroImmeuble = $this->getString('numeroImmeuble');
        $batiment = $this->getString('batiment', null);
        $escalier = $this->getString('escalier', null);
        $etage = $this->getString('etage', null);
        $datePassage = $this->getDate('datePassage');

        $prenom = $this->getString('prenom');
        $nom = $this->getString('nom');
        $adresse = $this->getString('adresse');
        $codePostal = $this->getString('codePostal');
        $ville = $this->getString('ville');
        $telephone = $this->getString('telephone');
        $email = $this->getString('email');

        $cuisine_ef_num = $this->getString('cuisine_ef_num', null);
        $cuisine_ef = $this->getInt('cuisine_ef', null);
        $salleDeBains_ef_num = $this->getString('salleDeBains_ef_num', null);
        $salleDeBains_ef = $this->getInt('salleDeBains_ef', null);
        $wc_ef_num = $this->getString('wc_ef_num', null);
        $wc_ef = $this->getInt('wc_ef', null);
        $autreEmplacement_ef_loc = $this->getString('autreEmplacement_ef_loc', null);
        $autreEmplacement_ef_num = $this->getString('autreEmplacement_ef_num', null);
        $autreEmplacement_ef = $this->getInt('autreEmplacement_ef', null);

        $cuisine_ec_num = $this->getString('cuisine_ec_num', null);
        $cuisine_ec = $this->getInt('cuisine_ec', null);
        $salleDeBains_ec_num = $this->getString('salleDeBains_ec_num', null);
        $salleDeBains_ec = $this->getInt('salleDeBains_ec', null);
        $wc_ec_num = $this->getString('wc_ec_num', null);
        $wc_ec = $this->getInt('wc_ec', null);
        $autreEmplacement_ec_loc = $this->getString('autreEmplacement_ec_loc', null);
        $autreEmplacement_ec_num = $this->getString('autreEmplacement_ec_num', null);
        $autreEmplacement_ec = $this->getInt('autreEmplacement_ec', null);

        // Relevés des compteurs
        $eauFroide = new ReleveCompteursDto(
            cuisineNum: $cuisine_ef_num,
            cuisine: $cuisine_ef,
            salleDeBainsNum: $salleDeBains_ef_num,
            salleDeBains: $salleDeBains_ef,
            wcNum: $wc_ef_num,
            wc: $wc_ef,
            autreEmplacementLoc: $autreEmplacement_ef_loc,
            autreEmplacementNum: $autreEmplacement_ef_num,
            autreEmplacement: $autreEmplacement_ef 
        );

        $eauChaude = new ReleveCompteursDto(
            cuisineNum: $cuisine_ec_num,
            cuisine: $cuisine_ec,
            salleDeBainsNum: $salleDeBains_ec_num,
            salleDeBains: $salleDeBains_ec,
            wcNum: $wc_ec_num,
            wc: $wc_ec,
            autreEmplacementLoc: $autreEmplacement_ec_loc,
            autreEmplacementNum: $autreEmplacement_ec_num,
            autreEmplacement: $autreEmplacement_ec 
        );

        return new GenerateReleveInputDto(
            numeroImmeuble: $numeroImmeuble,
            adresse: $adresse,
            batiment: $batiment,  
            codePostal: $codePostal,
            datePassage: $datePassage,
            eauChaude: $eauChaude,
            eauFroide: $eauFroide,
            email: $email,
            escalier: $escalier,
            etage: $etage,
            nom: $nom,
            prenom: $prenom,
            telephone: $telephone,
            ville: $ville
        );
    }

    private function getData(Request $request): void
    {
        $raw = (string) $request->getContent();
        $data = json_decode($raw, true);

        if (! is_array($data)) {
            $data = [];
        }

        $this->data = $data;
        // $this->validator->validate($this->data);
    }

    private function getDate(string $key): ?\DateTimeImmutable
    {
        return array_key_exists($key, $this->data) && null !== $this->data[$key]
            ? new \DateTimeImmutable($this->data[$key])
            : null;
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
