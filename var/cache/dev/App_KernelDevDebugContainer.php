<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerBpYxTBs\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerBpYxTBs/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerBpYxTBs.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerBpYxTBs\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerBpYxTBs\App_KernelDevDebugContainer([
    'container.build_hash' => 'BpYxTBs',
    'container.build_id' => 'a19d601e',
    'container.build_time' => 1640661149,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerBpYxTBs');
