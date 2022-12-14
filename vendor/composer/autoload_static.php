<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit04cf5dba7405b0a143b0a83ab7a37f94
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Aura\\SqlQuery\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Aura\\SqlQuery\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/sqlquery/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit04cf5dba7405b0a143b0a83ab7a37f94::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit04cf5dba7405b0a143b0a83ab7a37f94::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit04cf5dba7405b0a143b0a83ab7a37f94::$classMap;

        }, null, ClassLoader::class);
    }
}
