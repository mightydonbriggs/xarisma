<?php

namespace XarismaBundle;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;

/**
 * Program Config Object
 * 
 * This class manages program paths, configuration settings and the like, 
 * and provides access to same
 *
 * @author dbriggs
 */

class ProgramConfig {
    public static $configDir = null;
    private static $configValues = null;
    
    
    /**
     * Initialize the static object
     * 
     * This function will initialize the configuration values in the static
     * object, if they have not yet been initialized.
     */
    
    private static function init() {
        if (is_null(self::$configValues)) {
            self::$configDir = realpath(__DIR__ .'/config');
            $locator = new FileLocator(self::$configDir);
            $yamlConfigFiles = $locator->locate('config.yml', null, false);
            self::$configValues = Yaml::parse(file_get_contents($yamlConfigFiles[0]));
        }
    }
    
    
    /**
     * Get Configuration Parameter
     * 
     * This function will return a configuration parameter, if it is found in the
     * 'configValues' array. If the value is not found, this function will return
     * a 'false'. So be aware of this if you are looking for boolean values anyway.
     * 
     * @param string $paramName Name of the Param to be searched for
     * @return string|boolean
     */
    
    public static function getParam($paramName) {
        self::init();
        if(!key_exists($paramName, static::$configValues)) {
            return false;
        } else {
            return static::$configValues[$paramName];
        }
    }
    
    
    /**
     * Return Bundle Directory
     * 
     * This function will return the real path to the directory containing this
     * bundle.
     * 
     * @return string
     */
    
    public static function getBundleDir() {
        return realpath(__DIR__ );
    }
    
    
    /**
     * Get Import Directory
     * 
     * This function returns the real path to the Import directory. If the
     * realpath is not found, this function will return a null
     * 
     * @return string|null
     */
    public static function getImportDir() {
        $baseDir    = static::getBundleDir();
        $importDir  = static::getParam('fileops_import_dir');
        $importRealPath = realpath($baseDir .DIRECTORY_SEPARATOR .$importDir);
        return $importRealPath;
    }
    
    /**
     * Get Export Directory
     * 
     * This function returns the real path to the Export directory. If the
     * realpath is not found, this function will return a null
     * 
     * @return string|null
     */
    public static function getExportDir() {
        $baseDir    = static::getBundleDir();
        $exportDir  = static::getParam('fileops_export_dir');
        $exportRealPath = realpath($baseDir .DIRECTORY_SEPARATOR .$exportDir);
        return $exportRealPath;
    }
    
    
    
}
