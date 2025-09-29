<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Security;

use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\UserDto;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\Service\Jwt\JwtServiceDataProviderInterface;
use App\Application\Service\Redis\RedisServiceDataProviderInterface;

final class LoginUseCase
{
  public function __construct(
    private readonly SecurityDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(LoginInputDto $inputDto): LoginOutputDto
  {
    try {
      // Call SOAP service to authenticate
      return $this->serviceDataProvider->loginService($inputDto);

    } catch (\Exception $e) {
      return new LoginOutputDto(
        success: false,
        error: 'Login error: ' . $e->getMessage()
      );
    }
  }

  private function extractUserFromResponse(LoginOutputDto $response): ?UserDto
  {
    // This method should extract user data from the SOAP response
    // For now, we'll create a mock user based on the response structure
    // In real implementation, you'll need to modify the SOAP service to return UserDto
    return new UserDto(
      loginId: 'DEMOCLIENT',
      userName: $response->userName ?? 'Demo',
      email: 'noreply@techem.fr',
      userType: 'C',
      pkUser: 1043,
      address: '',
      postalCode: '',
      city: '',
      fk: 38227,
      phoneNumber: '',
      firstName: 'Client',
      userRole: 'MAISON MERE',
      clientName: '',
      clientId: 'C00892',
      expirationDate: '0001-01-01T00:00:00',
      passwordExpirationDate: '2025-11-18T14:53:44',
      cgu: 'O',
      fkClient: 38227,
      fkClientTop: 38227,
      nbImmeubles: -1,
      seuilConsoEf: -1,
      seuilConsoEc: -1,
      seuilConsoRepart: -1,
      seuilConsoCet: -1,
      seuilConsoActif: true,
      seuilConsoEmail: '',
      showImmeublesArc: false,
      showFactures: true,
      showChgtOccupant: true,
      showChantiers: true
    );
  }

  private function extractSessionIdFromResponse(LoginOutputDto $response): ?string
  {
    // This method should extract session ID from the SOAP response
    // For now, we'll return a mock session ID
    return '128b6158-f027-44cf-89e1-51391c54e99b';
  }
}
