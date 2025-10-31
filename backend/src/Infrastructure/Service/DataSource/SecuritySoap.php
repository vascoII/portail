<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\DataSource;

use App\Application\Dto\Input\Security\LoginFromParamInputDto;
use App\Application\Dto\Input\Security\LoginInputDto;
use App\Application\Dto\Input\Security\PatchEmailInputDto;
use App\Application\Dto\Input\Security\ResetPasswordFromPKUserInputDto;
use App\Application\Dto\Input\Security\ResetPasswordInputDto;
use App\Application\Dto\Input\Security\UpdatePasswordInputDto;
use App\Application\Service\Auth\AuthServiceInterface;
use App\Application\Service\DataSource\SecurityDataSourceInterface;
use App\Infrastructure\Service\Auth\AuthenticationContext;
use App\Infrastructure\Service\Hydrator\SecurityHydrator;
use App\Infrastructure\Service\Hydrator\SharedHydrator;

final class SecuritySoap extends Soap implements SecurityDataSourceInterface
{
    public function __construct(
        SoapClient $soapClient,
        private readonly SecurityHydrator $hydrator,
        private readonly SharedHydrator $sharedHydrator,
        private readonly AuthServiceInterface $authService
    ) {
        parent::__construct($soapClient);
    }

    public function fetchLogin(LoginInputDto $inputDto): object
    {
        $soapRequest = $this->hydrator->hydrateLogin($inputDto);

        return $this->safeCall('Login', $soapRequest);
    }

    public function fetchLoginFromParam(LoginFromParamInputDto $inputDto): object
    {
        $soapRequest = $this->hydrator->hydrateLoginFromParam($inputDto);

        return $this->safeCall('LoginFromParam', $soapRequest);
    }

    public function fetchLogout(): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);

        return $this->safeCall('Logout', (object) []);
    }

    public function fetchPatchCgu(): object
    {
        $authContext = $this->getAuthContext();
        $soapRequest = $this->sharedHydrator->hydratePatchCgu($authContext->pkUser);

        return $this->safeCall('UpdateCGUFromPKUser', $soapRequest);
    }

    public function fetchResetPassword(ResetPasswordInputDto $inputDto): object
    {
        $soapRequest = $this->hydrator->hydrateResetPassword($inputDto);

        return $this->safeCall('ResetPassword', $soapRequest);
    }

    public function fetchResetPasswordFromPKUser(ResetPasswordFromPKUserInputDto $inputDto): object
    {
        $soapRequest = $this->hydrator->hydrateResetPasswordFromPKUser($inputDto);

        return $this->safeCall('ResetPasswordFromPKUser', $soapRequest);
    }

    public function fetchUpdateEmailFromPKUser(PatchEmailInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $soapRequest = $this->sharedHydrator->hydrateUpdateEmailFromPKUser(
            $authContext->pkUser,
            $inputDto->email
        );

        return $this->safeCall('UpdateEmailFromPKUser', $soapRequest);
    }

    public function fetchUpdatePassword(UpdatePasswordInputDto $inputDto): object
    {
        $authContext = $this->getAuthContext();
        $this->soapClient->setAuthentication($authContext->sessionId, $authContext->pkUser);
        $soapRequest = $this->hydrator->hydrateUpdatePassword($inputDto);

        return $this->safeCall('UpdatePassword', $soapRequest);
    }

    private function getAuthContext(): AuthenticationContext
    {
        return AuthenticationContext::fromAuthService($this->authService);
    }
}
