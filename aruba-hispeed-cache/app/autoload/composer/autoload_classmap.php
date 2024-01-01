<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname(dirname($vendorDir));

return array(
    'ArubaSPA\\HiSpeedCache\\Admin\\AdminAssets' => $baseDir . '/app/src/Admin/AdminAssets.php',
    'ArubaSPA\\HiSpeedCache\\Admin\\AdminBar' => $baseDir . '/app/src/Admin/AdminBar.php',
    'ArubaSPA\\HiSpeedCache\\Admin\\AdminNotice' => $baseDir . '/app/src/Admin/AdminNotice.php',
    'ArubaSPA\\HiSpeedCache\\Admin\\AdminSettingPage' => $baseDir . '/app/src/Admin/AdminSettingPage.php',
    'ArubaSPA\\HiSpeedCache\\Admin\\Ajax\\CacheCleaner' => $baseDir . '/app/src/Admin/Ajax/CacheCleaner.php',
    'ArubaSPA\\HiSpeedCache\\Admin\\SiteHealth' => $baseDir . '/app/src/Admin/SiteHealth.php',
    'ArubaSPA\\HiSpeedCache\\ArubaHispeedCache' => $baseDir . '/app/src/ArubaHispeedCache.php',
    'ArubaSPA\\HiSpeedCache\\CacheWarmer\\Ajax\\CacheWarmer' => $baseDir . '/app/src/CacheWarmer/Ajax/CacheWarmer.php',
    'ArubaSPA\\HiSpeedCache\\CacheWarmer\\CacheWarmerManager' => $baseDir . '/app/src/CacheWarmer/CacheWarmerManager.php',
    'ArubaSPA\\HiSpeedCache\\Container\\ContainerBuilder' => $baseDir . '/app/src/Container/ContainerBuilder.php',
    'ArubaSPA\\HiSpeedCache\\Container\\ParamiterBag' => $baseDir . '/app/src/Container/ParamiterBag.php',
    'ArubaSPA\\HiSpeedCache\\Core\\ActionLinks' => $baseDir . '/app/src/Core/ActionLinks.php',
    'ArubaSPA\\HiSpeedCache\\Core\\I18n' => $baseDir . '/app/src/Core/I18n.php',
    'ArubaSPA\\HiSpeedCache\\Core\\Requirements' => $baseDir . '/app/src/Core/Requirements.php',
    'ArubaSPA\\HiSpeedCache\\Core\\ServiceCheck' => $baseDir . '/app/src/Core/ServiceCheck.php',
    'ArubaSPA\\HiSpeedCache\\Core\\Setup' => $baseDir . '/app/src/Core/Setup.php',
    'ArubaSPA\\HiSpeedCache\\Events\\AbstractEvents' => $baseDir . '/app/src/Events/AbstractEvents.php',
    'ArubaSPA\\HiSpeedCache\\Events\\BulkActionManager' => $baseDir . '/app/src/Events/BulkActionManager.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Comments\\PurgeProxyCacheOnDeletedComment' => $baseDir . '/app/src/Events/Comments/PurgeProxyCacheOnDeletedComment.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Comments\\PurgeProxyCacheOnNewComment' => $baseDir . '/app/src/Events/Comments/PurgeProxyCacheOnNewComment.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Comments\\PurgeProxyCacheTransitionCommentStatus' => $baseDir . '/app/src/Events/Comments/PurgeProxyCacheTransitionCommentStatus.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Deferred\\PurgeProxyCacheInDeferredMode' => $baseDir . '/app/src/Events/Deferred/PurgeProxyCacheInDeferredMode.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Plugins\\AbstractPluginEvent' => $baseDir . '/app/src/Events/Plugins/AbstractPluginEvent.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Plugins\\PurgeProxyCacheOnActivatedPlugin' => $baseDir . '/app/src/Events/Plugins/PurgeProxyCacheOnActivatedPlugin.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Plugins\\PurgeProxyCacheOnDeactivatedPlugin' => $baseDir . '/app/src/Events/Plugins/PurgeProxyCacheOnDeactivatedPlugin.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Plugins\\PurgeProxyCacheOnDeletePlugin' => $baseDir . '/app/src/Events/Plugins/PurgeProxyCacheOnDeletePlugin.php',
    'ArubaSPA\\HiSpeedCache\\Events\\PostType\\PurgeProxyCacheOnPostUpdated' => $baseDir . '/app/src/Events/PostType/PurgeProxyCacheOnPostUpdated.php',
    'ArubaSPA\\HiSpeedCache\\Events\\PostType\\PurgeProxyCacheOnTransitionStatus' => $baseDir . '/app/src/Events/PostType/PurgeProxyCacheOnTransitionStatus.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Term\\PurgeProxyCacheOnDeleteTerm' => $baseDir . '/app/src/Events/Term/PurgeProxyCacheOnDeleteTerm.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Term\\PurgeProxyCacheOnEditNavMenu' => $baseDir . '/app/src/Events/Term/PurgeProxyCacheOnEditNavMenu.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Term\\PurgeProxyCacheOnEditTerm' => $baseDir . '/app/src/Events/Term/PurgeProxyCacheOnEditTerm.php',
    'ArubaSPA\\HiSpeedCache\\Events\\Themes\\PurgeProxyCacheOnSwitchTheme' => $baseDir . '/app/src/Events/Themes/PurgeProxyCacheOnSwitchTheme.php',
    'ArubaSPA\\HiSpeedCache\\HeartBeat\\HeartBeatLimiter' => $baseDir . '/app/src/HeartBeat/HeartBeatLimiter.php',
    'ArubaSPA\\HiSpeedCache\\Helper\\AdminNotice' => $baseDir . '/app/src/Helper/AdminNotice.php',
    'ArubaSPA\\HiSpeedCache\\Purger\\AbstractPurger' => $baseDir . '/app/src/Purger/AbstractPurger.php',
    'ArubaSPA\\HiSpeedCache\\Purger\\WpPurger' => $baseDir . '/app/src/Purger/WpPurger.php',
    'ArubaSPA\\HiSpeedCache\\Request\\Request' => $baseDir . '/app/src/Request/Request.php',
    'ArubaSPA\\HiSpeedCache\\Settings\\MigrationsManagers' => $baseDir . '/app/src/Settings/MigrationsManagers.php',
    'ArubaSPA\\HiSpeedCache\\Settings\\RegisterSettings' => $baseDir . '/app/src/Settings/RegisterSettings.php',
    'ArubaSPA\\HiSpeedCache\\Traits\\HasContainer' => $baseDir . '/app/src/Traits/HasContainer.php',
    'ArubaSPA\\HiSpeedCache\\Traits\\Instance' => $baseDir . '/app/src/Traits/Instance.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
);