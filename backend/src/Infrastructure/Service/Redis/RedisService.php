<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Redis;

use App\Application\Dto\Output\Security\SessionDto;
use App\Application\Service\Redis\RedisServiceInterface;
use Predis\Client;

final class RedisService implements RedisServiceInterface
{
  private const SESSION_PREFIX = 'session:';
  private const USER_PREFIX = 'user:';

  public function __construct(
    private readonly Client $redis
  ) {}

  public function storeSession(string $tokenId, SessionDto $sessionDto, int $ttl = 3600): bool 
  {
    try {
      $key = self::SESSION_PREFIX . $tokenId;
      $sessionData = $this->sessionToArray($sessionDto);

      $this->redis->setex($key, $ttl, json_encode($sessionData));
      return true;
    } catch (\Exception $e) {
      return false;
    }
  }

  public function getSession(string $sessionId): ?SessionDto
  {
    try {
      $key = self::SESSION_PREFIX . $sessionId;
      $data = $this->redis->get($key);

      if (!$data) {
        return null;
      }

      $sessionData = json_decode($data, true);
      return $this->arrayToSession($sessionData);
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

  public function get(string $cacheKey)
  {
    try {
      $data = $this->redis->get($cacheKey);
      if (!$data) {
        return null;
      }

      $value = @unserialize($data);
      return $value === false && $data !== serialize(false) ? null : $value;
    } catch (\Throwable $e) {
      return null;
    }
  }

  public function set(string $cacheKey, $dto, ?int $ttl = null): bool
  {
    try {
      $payload = serialize($dto);
      // If TTL not provided, calculate based on current time
      if ($ttl === null) {
        $ttl = $this->calculateTtlUntilEndOfDay();
      }

      $this->redis->setex($cacheKey, $ttl, $payload);
      return true;
    } catch (\Throwable $e) {
      return false;
    }
  }

  private function calculateTtlUntilEndOfDay(): int
  {
    $now = new \DateTime();
    $endOfDay = (new \DateTime())->setTime(23, 59, 59);

    // If it's after 10 PM, use 1 hour TTL instead of until midnight
    if ($now->format('H') >= 22) {
      return 3600; // 1 hour
    }

    // Otherwise, cache until end of day
    $secondsUntilMidnight = $endOfDay->getTimestamp() - $now->getTimestamp();
    return max(300, $secondsUntilMidnight); // At least 5 minutes
  }

  private function sessionToArray(SessionDto $sessionDto): array
  {
    $session = $sessionDto->session;
    $user = $session->user;

    return [
        'connected' => $session->connected,
        'sessionId' => $session->sessionId,
        'user' => $user ? [
            'loginId' => $user->loginId,
            'userName' => $user->userName,
            'password' => $user->password,
            'email' => $user->email,
            'userType' => $user->userType,
            'pkUser' => $user->pkUser,
            'adresse' => $user->adresse,
            'cp' => $user->cp,
            'ville' => $user->ville,
            'fk' => $user->fk,
            'phoneNumber' => $user->phoneNumber,
            'firstName' => $user->firstName,
            'userRole' => $user->userRole,
            'clientName' => $user->clientName,
            'clientId' => $user->clientId,
            'expirationDate' => $user->expirationDate?->format('c'),
            'passwordExpirationDate' => $user->passwordExpirationDate?->format('c'),
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
            'showChantiers' => $user->showChantiers,
        ] : null,
    ];
  }
}
