# Logging and Exception System

This document explains the comprehensive logging and exception handling system implemented in the application.

## Overview

The system provides:

- **Structured logging** across all layers (Domain, Infrastructure, Application, HTTP)
- **Centralized exception handling** with automatic mapping to HTTP responses
- **Request tracking** with unique IDs for correlation
- **Performance monitoring** with response time tracking
- **Security features** including rate limiting and security headers
- **Data sanitization** to prevent sensitive information leakage

## Architecture

### Exception Hierarchy

```
Exception (PHP base)
├── DomainException (abstract)
│   ├── BusinessRuleException
│   └── ValidationException
├── InfrastructureException (abstract)
│   ├── SoapException (abstract)
│   │   ├── SoapTransportException
│   │   └── SoapBusinessException
│   ├── RedisException
│   └── JwtException
├── ApplicationException (abstract)
│   ├── UseCaseException
│   └── ServiceException
└── HttpException (abstract)
    ├── AuthenticationException (401)
    ├── AuthorizationException (403)
    ├── BadRequestException (400)
    └── InternalServerErrorException (500)
```

### Logging Channels

The system uses multiple Monolog channels for different purposes:

- **`http`** - HTTP request/response logging
- **`application`** - UseCase and business logic logging
- **`soap`** - External SOAP service calls
- **`transformer`** - Data transformation logging
- **`security`** - Authentication and authorization events

## Components

### HTTP Event Listeners

#### 1. GlobalExceptionListener

- **Purpose**: Centralized exception handling
- **Functionality**:
  - Catches all exceptions from any layer
  - Maps them to appropriate HTTP exceptions
  - Generates standardized API responses
  - Logs exceptions at appropriate levels
  - Handles environment-specific behavior

#### 2. RequestIdListener

- **Purpose**: Request tracking and correlation
- **Functionality**:
  - Generates unique request IDs for each API request
  - Adds request ID to response headers
  - Enables request tracing across the application

#### 3. CorsListener

- **Purpose**: CORS handling
- **Functionality**:
  - Handles preflight OPTIONS requests
  - Adds CORS headers to all responses
  - Configurable allowed origins, methods, and headers

#### 4. SecurityHeadersListener

- **Purpose**: Security headers
- **Functionality**:
  - Adds comprehensive security headers
  - Configurable security policies
  - HTTPS-specific headers

#### 5. RateLimitListener

- **Purpose**: Rate limiting
- **Functionality**:
  - Implements basic rate limiting for API endpoints
  - Configurable limits per endpoint
  - User-based and IP-based limiting

#### 6. RequestValidationListener

- **Purpose**: Request validation
- **Functionality**:
  - Validates request size limits
  - Validates content types
  - Validates JSON format

#### 7. ResponseTimeListener

- **Purpose**: Performance monitoring
- **Functionality**:
  - Measures request processing time
  - Logs slow requests
  - Adds response time headers

### Logger Processors

#### 1. RequestIdProcessor

- **Purpose**: Adds request ID to all log records
- **Functionality**:
  - Works with RequestIdListener
  - Adds request ID to log context for correlation

#### 2. UserContextProcessor

- **Purpose**: Adds user context to log records
- **Functionality**:
  - Adds authenticated user information
  - Includes user ID, username, and client ID

#### 3. SensitiveDataProcessor

- **Purpose**: Scrubs sensitive data from logs
- **Functionality**:
  - Masks passwords, tokens, and other sensitive data
  - Prevents sensitive information leakage in logs

#### 4. ExceptionContextProcessor

- **Purpose**: Adds structured exception context
- **Functionality**:
  - Enriches log records with exception metadata
  - Adds error codes, components, and operations
  - Provides retry information for infrastructure exceptions

### HTTP Logging Subscriber

#### HttpLoggingSubscriber

- **Purpose**: Detailed HTTP request/response logging
- **Functionality**:
  - Logs request details with payloads
  - Logs response details for errors
  - Integrates with other listeners
  - Provides comprehensive HTTP logging

## Configuration

### Services Configuration

All components are configured in `config/services.yaml`:

```yaml
# HTTP Event Listeners
App\Http\EventListener\GlobalExceptionListener:
  tags: ["kernel.event_subscriber"]
  arguments:
    $logger: "@monolog.logger.application"

App\Http\EventListener\RequestIdListener:
  tags: ["kernel.event_subscriber"]

App\Http\EventListener\CorsListener:
  tags: ["kernel.event_subscriber"]
  arguments:
    $allowedOrigins: ["*"]
    $allowedMethods: ["GET", "POST", "PUT", "DELETE", "OPTIONS"]
    $allowedHeaders: ["Content-Type", "Authorization", "X-Request-ID"]

# Logger Processors
App\Infrastructure\Logger\Processor\RequestIdProcessor:
  tags: ["monolog.processor"]

App\Infrastructure\Logger\Processor\UserContextProcessor:
  tags: ["monolog.processor"]

App\Infrastructure\Logger\Processor\SensitiveDataProcessor:
  tags: ["monolog.processor"]

App\Infrastructure\Logger\Processor\ExceptionContextProcessor:
  tags: ["monolog.processor"]
```

### Monolog Configuration

The system uses structured logging with JSON format:

```yaml
monolog:
  channels: ["http", "application", "soap", "transformer", "security"]

  handlers:
    http:
      type: stream
      path: "%kernel.logs_dir%/http.log"
      level: info
      channels: ["http"]
      formatter: monolog.formatter.json

    application:
      type: stream
      path: "%kernel.logs_dir%/application.log"
      level: debug
      channels: ["application"]
      formatter: monolog.formatter.json
```

## Usage Examples

### Exception Handling

```php
// In UseCase
try {
    $result = $this->soapService->call($method, $request);
} catch (SoapTransportException $e) {
    // Automatically mapped to InternalServerErrorException (500)
    throw $e;
}

// In Action
if (!$request->request->has('email')) {
    throw BadRequestException::missingField('email');
}
```

### Logging

```php
// In UseCase
$this->logger->info('User login attempted', [
    'username' => $username,
    'client_ip' => $request->getClientIp(),
]);

// In SOAP Service
$this->soapLogger->warning('SOAP call failed', [
    'service' => 'SecuritySoap',
    'operation' => 'login',
    'error' => $exception->getMessage(),
]);
```

### API Responses

All exceptions are automatically converted to standardized API responses:

```json
{
  "success": false,
  "error": {
    "code": "AUTHENTICATION_FAILED",
    "message": "Authentication token has expired",
    "status_code": 401
  },
  "request_id": "20241201-abc12345-def67890"
}
```

## Log Structure

### Request Log

```json
{
  "message": "HTTP Request received",
  "context": {
    "method": "POST",
    "uri": "https://api.example.com/security/login",
    "route": "security_login",
    "client_ip": "192.168.1.100",
    "user_agent": "Mozilla/5.0...",
    "content_type": "application/json",
    "request_body_size": 45
  },
  "extra": {
    "request_id": "20241201-abc12345-def67890",
    "user_id": 1043,
    "user_name": "Demo",
    "client_id": "C00892"
  }
}
```

### Exception Log

```json
{
  "message": "SOAP connection timeout after 30 seconds",
  "context": {
    "exception_class": "App\\Infrastructure\\Exception\\SoapTransportException",
    "http_status_code": 500,
    "error_code": "SOAP_CONNECTION_TIMEOUT",
    "service": "SecuritySoap",
    "operation": "login",
    "is_retryable": true,
    "retry_delay": 15
  },
  "extra": {
    "request_id": "20241201-abc12345-def67890",
    "exception_type": "infrastructure_exception",
    "retry_info": {
      "is_retryable": true,
      "retry_delay": 15,
      "max_retries": 1
    }
  }
}
```

## Security Features

### Rate Limiting

- Configurable limits per endpoint
- User-based and IP-based limiting
- Rate limit headers in responses

### Security Headers

- Content Security Policy
- HTTP Strict Transport Security
- X-Frame-Options
- X-Content-Type-Options
- Referrer Policy

### Data Sanitization

- Automatic masking of sensitive data
- Configurable sensitive key patterns
- Request/response body sanitization

## Performance Monitoring

### Response Time Tracking

- Automatic response time measurement
- Slow request detection and logging
- Response time headers

### Memory Monitoring

- Memory usage tracking
- Peak memory monitoring
- Memory leak detection

## Best Practices

### Exception Handling

1. **Use appropriate exception types** for each layer
2. **Provide meaningful error messages** and context
3. **Use factory methods** for common exceptions
4. **Let the global listener handle** HTTP response generation

### Logging

1. **Use structured logging** with consistent context
2. **Include request IDs** for correlation
3. **Log at appropriate levels** (debug, info, warning, error)
4. **Avoid logging sensitive data** (use processors)

### Performance

1. **Monitor slow requests** and optimize accordingly
2. **Use appropriate log levels** to avoid performance impact
3. **Configure log rotation** for production
4. **Monitor memory usage** and log growth

## Troubleshooting

### Common Issues

1. **Missing request IDs**: Ensure RequestIdListener is properly configured
2. **Duplicate logging**: Check event listener priorities
3. **Sensitive data in logs**: Verify SensitiveDataProcessor configuration
4. **Performance issues**: Check log levels and slow request thresholds

### Debugging

1. **Check log files** in `var/log/` directory
2. **Use request IDs** to trace requests across services
3. **Monitor exception logs** for error patterns
4. **Check rate limiting logs** for abuse patterns

## Future Enhancements

1. **Distributed tracing** with OpenTelemetry
2. **Metrics collection** with Prometheus
3. **Alerting system** for critical errors
4. **Log aggregation** with ELK stack
5. **Performance profiling** with Blackfire
