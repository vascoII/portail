<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource\ResponseProcessor;

class StringResponseProcessor implements SoapResponseProcessorInterface
{
    public function process(string $method, $response): string
    {
        if (is_object($response) && property_exists($response, $method . 'Result')) {
            $xmlEncoded = $response->{$method . 'Result'};
        } elseif (is_string($response)) {
            $xmlEncoded = $response;
        } else {
            throw new \InvalidArgumentException('Unsupported response format.');
        }

        // 🔧 Décodage des entités HTML
        $decoded = html_entity_decode($xmlEncoded, ENT_QUOTES | ENT_XML1, 'UTF-8');

        // 🔍 Vérification que c’est bien du XML
        if (false !== stripos($decoded, '<soap:Envelope')) {
            $dom = new \DOMDocument();
            $dom->loadXML($decoded);

            $resultNodes = $dom->getElementsByTagName($method . 'Result');
            if (0 === $resultNodes->length) {
                throw new \RuntimeException("No {$method}Result node found in SOAP response.");
            }

            return $resultNodes->item(0)->nodeValue;
        }

        // 🧾 Sinon, c’est juste une chaîne métier (ex: PDF encodé en base64)
        return $decoded;
    }

    public function supports(string $method): bool
    {
        return self::GET_REPORT === $method;
    }
}
