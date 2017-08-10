<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Helper;

use WBTranslator\Sdk\Exceptions\LocaleException;

/**
 * Class FilesystemHelper
 *
 * @package WBTranslator
 */
class FilesystemHelper
{
    public function getAllFiles($path)
    {
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        
        $arr = [];
        
        while ($iterator->valid()) {
            if (!$iterator->isDot()) {
                $arr[] = [
                    'basePathname' => dirname($path, 1),
                    'relativePathname' => $iterator->getSubPathName(),
                    'absolutePathname' => $iterator->key(),
                ];
            }
            
            $iterator->next();
        }
        
        return $arr;
    }
    
    public function getRequire($path)
    {
        if (is_file($path)) {
            return require $path;
        }
        
        throw new LocaleException("File does not exist at path {$path}");
    }
    
    public function makeDirectory($path, $mode = 0755, $recursive = false)
    {
        return mkdir($path, $mode, $recursive);
    }
}
