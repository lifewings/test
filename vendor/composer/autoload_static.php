<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb294fb21d4c5cf54e1d27e512b7e9205
{
    public static $prefixesPsr0 = array (
        'S' => 
        array (
            'Steampixel' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitb294fb21d4c5cf54e1d27e512b7e9205::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
