<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Redis;

use App\Application\Dto\Output\Security\UserDto;
use App\Domain\Service\Redis\RedisServiceInterface;
use Predis\Client;

final class RedisService implements RedisServiceInterface
{
  private const SESSION_PREFIX = 'session:';
  private const USER_PREFIX = 'user:';

  public function __construct(
    private readonly Client $redis
  ) {}

  public function storeSession(string $sessionId, UserDto $user, int $ttl = 3600): bool
  {
    try {
      $key = self::SESSION_PREFIX . $sessionId;
      $userData = $this->userToArray($user);

      $this->redis->setex($key, $ttl, json_encode($userData));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function getSession(string $sessionId): ?UserDto
  {
    try {
      $key = self::SESSION_PREFIX . $sessionId;
      $data = $this->redis->get($key);

      if (!$data) {
        return null;
      }

      $userData = json_decode($data, true);
      return $this->arrayToUser($userData);
    } catch (\Exception $e) {
      return null;
    }
  }

  public function deleteSession(string $sessionId): bool
  {
    try {
      $key = self::SESSION_PREFIX . $sessionId;
      return $this->redis->del($key) > 0;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function storeUserData(string $key, array $data, int $ttl = 3600): bool
  {
    try {
      $fullKey = self::USER_PREFIX . $key;
      $this->redis->setex($fullKey, $ttl, json_encode($data));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function getUserData(string $key): ?array
  {
    try {
      $fullKey = self::USER_PREFIX . $key;
      $data = $this->redis->get($fullKey);

      if (!$data) {
        return null;
      }

      return json_decode($data, true);
    } catch (\Exception $e) {
      return null;
    }
  }

  private function userToArray(UserDto $user): array
  {
    return [
      'loginId' => $user->loginId,
      'userName' => $user->userName,
      'email' => $user->email,
      'userType' => $user->userType,
      'pkUser' => $user->pkUser,
      'address' => $user->address,
      'postalCode' => $user->postalCode,
      'city' => $user->city,
      'fk' => $user->fk,
      'phoneNumber' => $user->phoneNumber,
      'firstName' => $user->firstName,
      'userRole' => $user->userRole,
      'clientName' => $user->clientName,
      'clientId' => $user->clientId,
      'expirationDate' => $user->expirationDate,
      'passwordExpirationDate' => $user->passwordExpirationDate,
      'cgu' => $user->cgu,
      'fkClient' => $user->fkClient,
      'fkClientTop' => $user->fkClientTop,
      'nbImmeubles' => $user->nbImmeubles,
      'seuilConsoEf' => $user->seuilConsoEf,
      'seuilConsoEc' => $user->seuilConsoEc,
      'seuilConsoRepart' => $user->seuilConsoRepart,
      'seuilConsoCet' => $user->seuilConsoCet,
      'seuilConsoActif' => $user->seuilConsoActif,
      'seuilConsoEmail' => $user->seuilConsoEmail,
      'showImmeublesArc' => $user->showImmeublesArc,
      'showFactures' => $user->showFactures,
      'showChgtOccupant' => $user->showChgtOccupant,
      'showChantiers' => $user->showChantiers
    ];
  }

  private function arrayToUser(array $data): UserDto
  {
    return new UserDto(
      loginId: $data['loginId'],
      userName: $data['userName'],
      email: $data['email'],
      userType: $data['userType'],
      pkUser: $data['pkUser'],
      address: $data['address'],
      postalCode: $data['postalCode'],
      city: $data['city'],
      fk: $data['fk'],
      phoneNumber: $data['phoneNumber'],
      firstName: $data['firstName'],
      userRole: $data['userRole'],
      clientName: $data['clientName'],
      clientId: $data['clientId'],
      expirationDate: $data['expirationDate'],
      passwordExpirationDate: $data['passwordExpirationDate'],
      cgu: $data['cgu'],
      fkClient: $data['fkClient'],
      fkClientTop: $data['fkClientTop'],
      nbImmeubles: $data['nbImmeubles'],
      seuilConsoEf: $data['seuilConsoEf'],
      seuilConsoEc: $data['seuilConsoEc'],
      seuilConsoRepart: $data['seuilConsoRepart'],
      seuilConsoCet: $data['seuilConsoCet'],
      seuilConsoActif: $data['seuilConsoActif'],
      seuilConsoEmail: $data['seuilConsoEmail'],
      showImmeublesArc: $data['showImmeublesArc'],
      showFactures: $data['showFactures'],
      showChgtOccupant: $data['showChgtOccupant'],
      showChantiers: $data['showChantiers']
    );
  }
}
