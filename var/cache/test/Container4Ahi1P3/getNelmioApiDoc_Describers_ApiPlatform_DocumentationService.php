<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'nelmio_api_doc.describers.api_platform.documentation' shared service.

include_once $this->targetDirs[3].'/vendor/api-platform/core/src/Documentation/Documentation.php';
include_once $this->targetDirs[3].'/vendor/symfony/http-foundation/Request.php';

return $this->privates['nelmio_api_doc.describers.api_platform.documentation'] = ($this->services['api_platform.action.documentation'] ?? $this->load('getApiPlatform_Action_DocumentationService.php'))->__invoke(new \Symfony\Component\HttpFoundation\Request());