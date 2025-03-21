<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5346106f0338966b66acd7dca22602aa
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5346106f0338966b66acd7dca22602aa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5346106f0338966b66acd7dca22602aa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5346106f0338966b66acd7dca22602aa::$classMap;

        }, null, ClassLoader::class);
    }
}
