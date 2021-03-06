<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Openovate Labs
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Image;

use Exception;

/**
 * Image exceptions
 *
 * @package  Cradle
 * @category Image
 * @author   Christian Blanquera <cblanquera@openovate.com>
 * @standard PSR-2
 */
class ImageException extends Exception
{
    /**
     * @const string GD_NOT_INSTALLED GD Error template
     */
    const GD_NOT_INSTALLED = 'PHP GD Library is not installed.';

    /**
     * @const string NOT_VALID_IMAGE_FILE Error template
     */
    const NOT_VALID_IMAGE_FILE = '%s is not a valid image file.';
    
    /**
     * Create a new exception for invalid callback
     *
     * @param  *string $name
     *
     * @return RouterException
     */
    public static function forGDNotInstalled()
    {
        return new static(static::GD_NOT_INSTALLED);
    }
    
    /**
     * Create a new exception for invalid callback
     *
     * @param  *string $name
     *
     * @return RouterException
     */
    public static function forInvalidImageFile($path)
    {
        return new static(sprintf(static::NOT_VALID_IMAGE_FILE, $path));
    }
}
