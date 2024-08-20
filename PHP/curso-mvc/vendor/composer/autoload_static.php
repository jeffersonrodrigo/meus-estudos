<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit410b27abed25c3e7eb047b182294ba7c
{
    public static $files = array (
        '8cad9c8c15594f6bcaf652a66230593a' => __DIR__ . '/../..' . '/config/config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'core\\' => 5,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'J' => 
        array (
            'Jefferson\\Cursomvc\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Jefferson\\Cursomvc\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit410b27abed25c3e7eb047b182294ba7c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit410b27abed25c3e7eb047b182294ba7c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit410b27abed25c3e7eb047b182294ba7c::$classMap;

        }, null, ClassLoader::class);
    }
}
