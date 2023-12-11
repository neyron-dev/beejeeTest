<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit70d85cb7d4bb8ced1e01afcabf647fd9
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit70d85cb7d4bb8ced1e01afcabf647fd9', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit70d85cb7d4bb8ced1e01afcabf647fd9', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit70d85cb7d4bb8ced1e01afcabf647fd9::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
