<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerI4dMvWd\srcApp_KernelTestDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerI4dMvWd/srcApp_KernelTestDebugContainer.php') {
    touch(__DIR__.'/ContainerI4dMvWd.legacy');

    return;
}

if (!\class_exists(srcApp_KernelTestDebugContainer::class, false)) {
    \class_alias(\ContainerI4dMvWd\srcApp_KernelTestDebugContainer::class, srcApp_KernelTestDebugContainer::class, false);
}

return new \ContainerI4dMvWd\srcApp_KernelTestDebugContainer([
    'container.build_hash' => 'I4dMvWd',
    'container.build_id' => 'ab6312b0',
    'container.build_time' => 1564995119,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerI4dMvWd');
