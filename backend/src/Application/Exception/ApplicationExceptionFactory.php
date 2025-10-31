<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Domain\Exception\DomainException;
use App\Infrastructure\Exception\InfrastructureException;

/**
 * Factory for creating application exceptions with common patterns.
 */
final class ApplicationExceptionFactory
{
    public static function authServiceFailed(
        string $operation,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): ServiceException {
        return self::serviceMethodFailed(
            'AuthService',
            $operation,
            $reason,
            $inputData
        );
    }

    public static function factureUseCaseFailed(
        string $operation,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): UseCaseException {
        return self::useCaseExecutionFailed(
            'FactureUseCase',
            $operation,
            $reason,
            'FactureInputDto',
            'FactureOutputDto',
            $inputData,
            $previous
        );
    }

    public static function immeubleUseCaseFailed(
        string $operation,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): UseCaseException {
        return self::useCaseExecutionFailed(
            'ImmeubleUseCase',
            $operation,
            $reason,
            'ImmeubleInputDto',
            'ImmeubleOutputDto',
            $inputData,
            $previous
        );
    }

    public static function jwtServiceFailed(
        string $operation,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): ServiceException {
        return self::serviceMethodFailed(
            'JwtService',
            $operation,
            $reason,
            $inputData
        );
    }

    /**
     * Common UseCase Patterns.
     */
    public static function loginUseCaseFailed(
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): UseCaseException {
        return self::useCaseExecutionFailed(
            'LoginUseCase',
            'authentication',
            $reason,
            'LoginInputDto',
            'LoginOutputDto',
            $inputData,
            $previous
        );
    }

    public static function redisServiceFailed(
        string $operation,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): ServiceException {
        return self::serviceMethodFailed(
            'RedisService',
            $operation,
            $reason,
            $inputData
        );
    }

    public static function serviceBusinessLogicViolation(
        string $serviceClass,
        string $serviceMethod,
        string $rule,
        string $message,
        array $inputData = [],
        array $context = []
    ): ServiceException {
        return ServiceException::businessLogicViolation(
            $serviceClass,
            $serviceMethod,
            $rule,
            $message,
            $inputData,
            $context
        );
    }

    public static function serviceConfigurationError(
        string $serviceClass,
        string $configKey,
        string $expectedType,
        mixed $actualValue,
        array $serviceConfig = []
    ): ServiceException {
        return ServiceException::configurationError(
            $serviceClass,
            $configKey,
            $expectedType,
            $actualValue,
            $serviceConfig
        );
    }

    public static function serviceDependencyFailed(
        string $serviceClass,
        string $dependencyClass,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): ServiceException {
        return ServiceException::dependencyFailed(
            $serviceClass,
            $dependencyClass,
            $reason,
            $inputData,
            $previous
        );
    }

    /**
     * Service Exceptions.
     */
    public static function serviceInitializationFailed(
        string $serviceClass,
        string $reason,
        array $serviceConfig = [],
        ?\Exception $previous = null
    ): ServiceException {
        return ServiceException::initializationFailed(
            $serviceClass,
            $reason,
            $serviceConfig,
            $previous
        );
    }

    public static function serviceMethodFailed(
        string $serviceClass,
        string $serviceMethod,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): ServiceException {
        return ServiceException::methodFailed(
            $serviceClass,
            $serviceMethod,
            $reason,
            $inputData,
            $previous
        );
    }

    /**
     * Common Service Patterns.
     */
    public static function soapServiceFailed(
        string $serviceClass,
        string $method,
        string $reason,
        array $inputData = [],
        ?\Exception $previous = null
    ): ServiceException {
        return self::serviceMethodFailed(
            $serviceClass,
            $method,
            $reason,
            $inputData,
            $previous
        );
    }

    public static function useCaseBusinessLogicViolation(
        string $useCaseClass,
        string $rule,
        string $message,
        ?string $inputDtoClass = null,
        ?string $outputDtoClass = null,
        array $inputData = [],
        array $context = []
    ): UseCaseException {
        return UseCaseException::businessLogicViolation(
            $useCaseClass,
            $rule,
            $message,
            $inputDtoClass,
            $outputDtoClass,
            $inputData,
            $context
        );
    }

    /**
     * UseCase Exceptions.
     */
    public static function useCaseExecutionFailed(
        string $useCaseClass,
        string $operation,
        string $reason,
        ?string $inputDtoClass = null,
        ?string $outputDtoClass = null,
        array $inputData = [],
        ?\Exception $previous = null
    ): UseCaseException {
        return UseCaseException::executionFailed(
            $useCaseClass,
            $operation,
            $reason,
            $inputDtoClass,
            $outputDtoClass,
            $inputData,
            $previous
        );
    }

    public static function useCaseServiceOrchestrationFailed(
        string $useCaseClass,
        string $serviceName,
        string $operation,
        string $reason,
        ?string $inputDtoClass = null,
        ?string $outputDtoClass = null,
        array $inputData = [],
        ?\Exception $previous = null
    ): UseCaseException {
        return UseCaseException::serviceOrchestrationFailed(
            $useCaseClass,
            $serviceName,
            $operation,
            $reason,
            $inputDtoClass,
            $outputDtoClass,
            $inputData,
            $previous
        );
    }

    public static function useCaseTransformationFailed(
        string $useCaseClass,
        string $sourceType,
        string $targetType,
        string $reason,
        ?string $inputDtoClass = null,
        ?string $outputDtoClass = null,
        array $inputData = [],
        ?\Exception $previous = null
    ): UseCaseException {
        return UseCaseException::transformationFailed(
            $useCaseClass,
            $sourceType,
            $targetType,
            $reason,
            $inputDtoClass,
            $outputDtoClass,
            $inputData,
            $previous
        );
    }

    /**
     * Exception Wrapping.
     */
    public static function wrapDomainException(
        DomainException $domainException,
        string $useCaseClass,
        ?string $inputDtoClass = null,
        ?string $outputDtoClass = null,
        array $inputData = []
    ): UseCaseException {
        return UseCaseException::fromDomainException(
            $domainException,
            $useCaseClass,
            $inputDtoClass,
            $outputDtoClass,
            $inputData
        );
    }

    public static function wrapInfrastructureException(
        InfrastructureException $infrastructureException,
        string $useCaseClass,
        ?string $inputDtoClass = null,
        ?string $outputDtoClass = null,
        array $inputData = []
    ): UseCaseException {
        return UseCaseException::fromInfrastructureException(
            $infrastructureException,
            $useCaseClass,
            $inputDtoClass,
            $outputDtoClass,
            $inputData
        );
    }

    public static function wrapInfrastructureExceptionAsService(
        InfrastructureException $infrastructureException,
        string $serviceClass,
        string $serviceMethod = '',
        array $inputData = []
    ): ServiceException {
        return ServiceException::fromInfrastructureException(
            $infrastructureException,
            $serviceClass,
            $serviceMethod,
            $inputData
        );
    }
}
