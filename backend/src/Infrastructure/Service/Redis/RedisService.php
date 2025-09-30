<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Redis;

use App\Application\Dto\Output\Security\UserDto;
use App\Application\Service\Redis\RedisServiceInterface;
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
}
