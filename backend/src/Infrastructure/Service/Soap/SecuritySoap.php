<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Security\CreateInputDto;
use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Domain\Service\Soap\SecuritySoapInterface;
use App\Infrastructure\Hydrator\SecurityHydrator;
use App\Domain\Service\Auth\AuthServiceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Soap\SoapClient;

final class SecuritySoap implements SecuritySoapInterface
{
  public function __construct(
    private readonly SoapClient $soapClient,
    private readonly SecurityHydrator $hydrator,
    private readonly AuthServiceInterface $authService
  ) {}

  private function getAuthContext(): AuthenticationContext
  {
    return AuthenticationContext::fromAuthService($this->authService);
  }

  public function createService(CreateInputDto $inputDto): array
  {
    // TODO: Implement createService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function loginFromParamService(LoginFromParamInputDto $inputDto): array
  {
    // TODO: Implement loginFromParamService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function logoutService(): array
  {
    // TODO: Implement logoutService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function resetOrCreateService(ResetOrCreateInputDto $inputDto): array
  {
    // TODO: Implement resetOrCreateService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function updatePasswordService(UpdatePasswordInputDto $inputDto): array
  {
    // TODO: Implement updatePasswordService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function resetPasswordService(ResetPasswordInputDto $inputDto): array
  {
    // TODO: Implement resetPasswordService logic
    $authContext = $this->getAuthContext();
    $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
    return [];
  }

  public function loginService(LoginInputDto $inputDto): LoginOutputDto
  {
    try {
      // TODO: Implement SOAP call to external service
      // This is a mock implementation - replace with actual SOAP call
      $soapResponse = $this->mockSoapLogin($inputDto->username, $inputDto->password);

      if (!$soapResponse['Connected']) {
        return new LoginOutputDto(
          success: false,
          error: $soapResponse['Erreur'] ?? 'Authentication failed'
        );
      }

      // Convert SOAP response to UserDto
      $user = $this->convertSoapResponseToUser($soapResponse['User']);

      return new LoginOutputDto(
        success: true,
        jwt: 'mock_jwt_token', // Will be replaced by actual JWT generation
        userName: $user->userName
      );
    } catch (\Exception $e) {
      return new LoginOutputDto(
        success: false,
        error: 'Login service error: ' . $e->getMessage()
      );
    }
  }

  private function mockSoapLogin(string $username, string $password): array
  {
    // Mock SOAP response based on your example
    return [
      'Erreur' => '',
      'Info' => '',
      'Connected' => true,
      'SessionID' => '128b6158-f027-44cf-89e1-51391c54e99b',
      'User' => [
        'Erreur' => '',
        'Info' => '',
        'LoginID' => 'DEMOCLIENT',
        'UserName' => 'Demo',
        'Password' => 'Techem92',
        'EMail' => 'noreply@techem.fr',
        'UserType' => 'C',
        'PKUser' => 1043,
        'Adresse' => '',
        'CP' => '',
        'Ville' => '',
        'FK' => 38227,
        'PhoneNumber' => '',
        'FirstName' => 'Client',
        'UserRole' => 'MAISON MERE',
        'ClientName' => '',
        'ClientID' => 'C00892',
        'ExpirationDate' => '0001-01-01T00:00:00',
        'PasswordExpirationDate' => '2025-11-18T14:53:44',
        'CGU' => 'O',
        'FKClient' => 38227,
        'FKClientTop' => 38227,
        'NbImmeubles' => -1,
        'Seuil_Conso_EF' => -1,
        'Seuil_Conso_EC' => -1,
        'Seuil_Conso_Repart' => -1,
        'Seuil_Conso_CET' => -1,
        'Seuil_Conso_Actif' => true,
        'Seuil_Conso_Email' => '',
        'showImmeublesArc' => false,
        'showFactures' => true,
        'showChgtOccupant' => true,
        'showChantiers' => true
      ]
    ];
  }

  private function convertSoapResponseToUser(array $userData): \App\Application\Dto\Output\Security\UserDto
  {
    return new \App\Application\Dto\Output\Security\UserDto(
      loginId: $userData['LoginID'],
      userName: $userData['UserName'],
      email: $userData['EMail'],
      userType: $userData['UserType'],
      pkUser: $userData['PKUser'],
      address: $userData['Adresse'],
      postalCode: $userData['CP'],
      city: $userData['Ville'],
      fk: $userData['FK'],
      phoneNumber: $userData['PhoneNumber'],
      firstName: $userData['FirstName'],
      userRole: $userData['UserRole'],
      clientName: $userData['ClientName'],
      clientId: $userData['ClientID'],
      expirationDate: $userData['ExpirationDate'],
      passwordExpirationDate: $userData['PasswordExpirationDate'],
      cgu: $userData['CGU'],
      fkClient: $userData['FKClient'],
      fkClientTop: $userData['FKClientTop'],
      nbImmeubles: $userData['NbImmeubles'],
      seuilConsoEf: $userData['Seuil_Conso_EF'],
      seuilConsoEc: $userData['Seuil_Conso_EC'],
      seuilConsoRepart: $userData['Seuil_Conso_Repart'],
      seuilConsoCet: $userData['Seuil_Conso_CET'],
      seuilConsoActif: $userData['Seuil_Conso_Actif'],
      seuilConsoEmail: $userData['Seuil_Conso_Email'],
      showImmeublesArc: $userData['showImmeublesArc'],
      showFactures: $userData['showFactures'],
      showChgtOccupant: $userData['showChgtOccupant'],
      showChantiers: $userData['showChantiers']
    );
  }
}
