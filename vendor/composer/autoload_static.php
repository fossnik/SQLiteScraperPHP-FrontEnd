<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9c2cf9e646e13dd1c003ce6e3867e7a5
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
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9c2cf9e646e13dd1c003ce6e3867e7a5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9c2cf9e646e13dd1c003ce6e3867e7a5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
