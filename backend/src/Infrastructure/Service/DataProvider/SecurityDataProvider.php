<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataProvider;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\ResetOrCreateInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Dto\Output\Security\LoginOutputDto;
use App\Application\Dto\Output\Security\LogoutOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto;
use App\Application\Dto\Output\Security\ResetPasswordOutputDto;
use App\Application\Dto\Output\Security\UpdatePasswordOutputDto;
use App\Application\Dto\Output\Shared\SuccessOutputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataProvider\SecurityDataProviderInterface;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Application\Service\Jwt\JwtServiceInterface;
use App\Application\Service\Redis\RedisServiceInterface;
use App\Application\Service\Transformer\SecurityTransformerInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;

final class SecurityDataProvider implements SecurityDataProviderInterface
{
    public function __construct(
        private readonly SecurityDataSourceInterface $securityDataSource,
        private readonly SecurityTransformerInterface $securityTransformer,
        private readonly AuthServiceInterface $authService,
        private readonly JwtServiceInterface $serviceJwt,
        private readonly RedisServiceInterface $serviceRedis
    ) {}

    public function patchCguService(): SuccessOutputDto
    {
        $rawData = $this->securityDataSource->fetchPatchCgu();
        return $this->securityTransformer->transformPatchCgu($rawData);
    }

    public function loginFromParamService(LoginFromParamInputDto $inputDto): LoginOutputDto
    {
        $rawData = $this->securityDataSource->fetchLoginFromParam($inputDto);
        $sessionDto = $this->securityTransformer->transformLoginFromParam($rawData);

        $token = $this->serviceJwt->generateToken($sessionDto);
        // Store session keyed by the backend sessionId for consistency with middleware
        $this->serviceRedis->storeSession($sessionDto->session->sessionId, $sessionDto);

        return $this->securityTransformer->transformToLoginOutput($sessionDto, $token);
    }

    public function loginService(LoginInputDto $inputDto): LoginOutputDto
    {
        $rawData = $this->securityDataSource->fetchLogin($inputDto);
        $sessionDto = $this->securityTransformer->transformLoginToSession($rawData);

        $token = $this->serviceJwt->generateToken($sessionDto);
        // Store session keyed by the backend sessionId for consistency with middleware
        $this->serviceRedis->storeSession($sessionDto->session->sessionId, $sessionDto);

        return $this->securityTransformer->transformToLoginOutput($sessionDto, $token);
    }

    public function logoutService(): LogoutOutputDto
    {
        $rawData = $this->securityDataSource->fetchLogout();
        $output = $this->securityTransformer->transformLogout($rawData);

        if ($output->success) {
            $sessionId = $this->authService->getCurrentSessionId();
            if ($sessionId) {
                $this->serviceRedis->deleteSession($sessionId);
            }
            $this->authService->clearAuthenticatedUser();
        }

        return $output;
    }

    public function resetOrCreateService(ResetOrCreateInputDto $inputDto): ResetPasswordFromPKUserOutputDto
    {
        $rawData = $this->securityDataSource->fetchResetOrCreate($inputDto);

        return $this->securityTransformer->transformResetOrCreateResponse($rawData);
    }

    public function resetPasswordService(ResetPasswordInputDto $inputDto): ResetPasswordOutputDto
    {
        $rawData = $this->securityDataSource->fetchResetPassword($inputDto);
        $success = $this->securityTransformer->transformResetPassword($rawData);

        return new ResetPasswordOutputDto($success);
    }

    public function updatePasswordService(UpdatePasswordInputDto $inputDto): UpdatePasswordOutputDto
    {
        $rawData = $this->securityDataSource->fetchUpdatePassword($inputDto);

        return $this->securityTransformer->transformUpdatePassword($rawData);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
