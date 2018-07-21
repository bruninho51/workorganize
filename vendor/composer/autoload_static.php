<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticIniteba204878a11ecdc7e667192852c096d
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'model\\' => 6,
        ),
        'l' => 
        array (
            'lib\\factory\\' => 12,
        ),
        'i' => 
        array (
            'interfaces\\' => 11,
        ),
        'h' => 
        array (
            'helper\\' => 7,
        ),
        'c' => 
        array (
            'controller\\' => 11,
            'config\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/model',
        ),
        'lib\\factory\\' => 
        array (
            0 => __DIR__ . '/../..' . '/lib/factory',
        ),
        'interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/interfaces',
        ),
        'helper\\' => 
        array (
            0 => __DIR__ . '/../..' . '/helper',
        ),
        'controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controller',
        ),
        'config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
    );

    public static $classMap = array (
        'config\\env' => __DIR__ . '/../..' . '/config/env.php',
        'controller\\Login' => __DIR__ . '/../..' . '/controller/Login.php',
        'controller\\Principal' => __DIR__ . '/../..' . '/controller/Principal.php',
        'helper\\helper' => __DIR__ . '/../..' . '/helper/helper.php',
        'interfaces\\iModel' => __DIR__ . '/../..' . '/interfaces/iModel.php',
        'lib\\factory\\FactoryController' => __DIR__ . '/../..' . '/lib/factory/FactoryController.php',
        'lib\\factory\\FactoryCss' => __DIR__ . '/../..' . '/lib/factory/FactoryCss.php',
        'lib\\factory\\FactoryJS' => __DIR__ . '/../..' . '/lib/factory/FactoryJS.php',
        'lib\\factory\\FactoryModel' => __DIR__ . '/../..' . '/lib/factory/FactoryModel.php',
        'lib\\factory\\FactoryView' => __DIR__ . '/../..' . '/lib/factory/FactoryView.php',
        'model\\AbstractModel' => __DIR__ . '/../..' . '/model/AbstractModel.php',
        'model\\DB' => __DIR__ . '/../..' . '/model/DB.php',
        'model\\DashboardDAO' => __DIR__ . '/../..' . '/model/DashboardDAO.php',
        'model\\TrabalhoDAO' => __DIR__ . '/../..' . '/model/TrabalhoDAO.php',
        'model\\UsuarioDAO' => __DIR__ . '/../..' . '/model/UsuarioDAO.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticIniteba204878a11ecdc7e667192852c096d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticIniteba204878a11ecdc7e667192852c096d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticIniteba204878a11ecdc7e667192852c096d::$classMap;

        }, null, ClassLoader::class);
    }
}
