<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container2zZ8W4M\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container2zZ8W4M/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container2zZ8W4M.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container2zZ8W4M\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \Container2zZ8W4M\srcApp_KernelDevDebugContainer([
    'container.build_hash' => '2zZ8W4M',
    'container.build_id' => 'f249f026',
    'container.build_time' => 1572277772,
], __DIR__.\DIRECTORY_SEPARATOR.'Container2zZ8W4M');
