<?php
declare(strict_types=1);

namespace WBTranslator\Sdk\Helper;

use WBTranslator\Sdk\Exceptions\LocatorException;

/**
 * Class FilesystemHelper
 *
 * @package WBTranslator
 */
class FilesystemHelper
{
    /**
     * @param $path
     *
     * @return array
     */
    public function getAllFiles(string $path): array
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
    
    public function getRequire(string $path)
    {
        if (is_file($path)) {
            return require $path;
        }
        
        throw new LocatorException("File does not exist at path {$path}");
    }
    
    public function makeDirectory($path, $mode = 0755, $recursive = false)
    {
        return mkdir($path, $mode, $recursive);
    }
}
