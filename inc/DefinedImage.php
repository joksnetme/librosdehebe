<?php

class DefinedImage
{
    protected $fileOriginal = '';
    protected $fileResized = '';

    protected $imageOriginal = 0;
    protected $imageOriginalWidth = 0;
    protected $imageOriginalHeight = 0;

    protected $imageOriginalTypeCode = -1;
    protected $imageOriginalTypeAbbr = '';
    protected $imageOriginalHtmlSizes = '';

    protected $imageResized = 0;
    protected $imageResizedWidth = 0;
    protected $imageResizedHeight = 0;
    protected $imageResizedTypeCode = -1;
    protected $imageResizedTypeAbbr = '';
    protected $imageResizedHtmlSizes = '';

    protected $width  = 0;
    protected $height = 0;

    protected $parameters = array(
        'jpegQuality' => 85,
        'useGD2'      => true
    );

    public static function load( $fileOriginal )
    {
        return new DefinedImage($fileOriginal);
    }

    public function __construct( $fileOriginal )
    {
        $this->clear(); // clear all.

        if ( file_exists($fileOriginal) )
        {
            $this->fileOriginal = $fileOriginal;
            $this->imageOriginal = $this->imageCreateFromFile($fileOriginal);

            if ( !( $this->imageOriginal ) )
            {
                return $this->error(
                    "Image not created from file '$fileOriginal'."
                );
            }
        }
        else
        {
            return $this->error(
                "The file '$fileOriginal' does not exist."
            );
        }

        return true;
    }

    /**
     * Clear all the class member varaibles
     *
     * @return DefinedImage
     */
    public function clear()
    {
        $this->fileOriginal = '';
        $this->fileResized = '';

        $this->imageOriginal       = 0;
        $this->imageOriginalWidth  = 0;
        $this->imageOriginalHeight = 0;

        $this->imageOriginalTypeCode  = 0;
        $this->imageOriginalTypeAbbr  = '';
        $this->imageOriginalHtmlSizes = '';

        $this->imageResized          = 0;
        $this->imageResizedWidth     = 0;
        $this->imageResizedHeight    = 0;
        $this->imageResizedTypeCode  = -1;
        $this->imageResizedTypeAbbr  = '';
        $this->imageResizedHtmlSizes = '';

        $this->setParameters();

        return $this;
    }

    /**
     * Change JPG quality
     *
     * @param integer $quality
     * @return DefinedImage
     */
    public function quality( $quality = 85 )
    {
        if ( !( is_numeric($quality) ) )
            return $this;

        $this->parameters['jpegQuality'] = $quality;

        return $this;
    }

    /**
     * Set parameters
     *
     * @param integer $jpegQuality
     * @param boolean $useGD2
     * @return DefinedImage
     */
    public function setParameters( $jpegQuality = 85, $useGD2 = true )
    {
        settype($jpegQuality, 'integer');
        settype($useGD2, 'boolean');

        $this->parameters['jpegQuality'] = $jpegQuality;
        $this->parameters['useGD2'] = $useGD2;

        return $this;
    }

    /**
     * Trigger an error
     *
     * @param string $message
     * @return boolean
     */
    protected function error( $message )
    {
        return trigger_error($message, E_ERROR);
    }

    protected function imageCreateFromFile( $filename )
    {
        $img = 0;
        $imgSize = getimagesize($filename);

        ####### Now create original image from uploaded file. Be carefull!
        ####### GIF is often not supported, as far as I remember from GD 1.6

        switch ( $imgSize[2] )
        {
            case 1:
                $img = $this->imageCheckAndCreate("ImageCreateFromGif", $filename);
                $imgType = "GIF";
                break;

            case 2:
                $img = $this->imageCheckAndCreate("ImageCreateFromJpeg", $filename);
                $imgType = "JPG";
                break;

            case 3:
                $img = $this->imageCheckAndCreate("ImageCreateFromPng", $filename);
                $imgType = "PNG";
                break;

            // would be nice if this function will be finally supported
            case 4:
                $img = $this->imageCheckAndCreate("ImageCreateFromSwf", $filename);
                $imgType = "SWF";
                break;

            default:
                $img = 0;
                $imgType = "UNKNOWN";

                $this->error(
                    "Can not create image. Sorry, this image type is not supported yet."
                );

                break;
        } // switch

        if ( $img )
        {
            $this->imageOriginalWidth     = $imgSize[0];
            $this->imageOriginalHeight    = $imgSize[1];
            $this->imageOriginalTypeCode  = $imgSize[2];
            $this->imageOriginalTypeAbbr  = $imgType;
            $this->imageOriginalHtmlSizes = $imgSize[3];
        }
        else
            $this->clear();

        return $img;
    }

    /**
     * Inner function used from imageCreateFromFile().
     * Checks if the function exists and returns
     * created image or false.
     *
     * @param string $function
     * @param string $filename
     * @return mixed
     */
    protected function imageCheckAndCreate( $function, $filename )
    {
        if ( function_exists($function) )
            return $function($filename);
        else
        {
            return $this->error(
                "The function '$function' does not exist."
            );
        }
    }

    /**
     * Set the width
     *
     * @param integer $width
     * @return DefinedImage
     */
    public function width( $width )
    {
        $this->width = $width;
        return $this;
    }

    /**
     * Set the height
     *
     * @param integer $height
     * @return DefinedImage
     */
    public function height( $height )
    {
        $this->height = $height;
        return $this;
    }

    /**
     * This is core function -- it resizes created image
     * If any of parameters == "*" then no resizing on this parameter
     *
     * >> mode = "+" then image is resized to cover the region specified
     * by $desiredWidth, $desiredHeight
     *
     * >> mode = "-" then image is resized to fit into the region
     * specified by $desiredWidth, $desiredHeight
     *
     * width-to-height ratio is all the time the same.
     *
     * >>mode = 0 then image will be exactly resized to $desiredWidth
     * $desiredHeight. Geometrical distortion can occur in this case.
     *
     * Say u have picture 400x300 and there is circle on the picture,
     * now u resized in mode=0 to 800x300 -- circle shape will be
     * distorted and will look like ellipse.
     *
     * GD2 provides much better quality but is not everywhere installed.
     *
     * @param integer $desiredWidth
     * @param integer $desiredHeight
     * @param string $mode
     * @return DefinedImage
     */
    public function resize( $desiredWidth = null, $desiredHeight = null, $mode = '-' )
    {
        if ( null === $desiredWidth )
            $desiredWidth = ( $this->width ) ? $this->width : '*';

        if ( null === $desiredHeight )
            $desiredHeight = ( $this->height ) ? $this->height : '*';

        if ( $desiredWidth == "*" && $desiredHeight == "*" )
        {
            $this->imageResized = $this->imageOriginal;
            return $this;
        }

        switch ( $mode )
        {
            case '-':
            case '+':
                // multipliers
                if ( $desiredWidth != "*" )
                    $multX = $desiredWidth / $this->imageOriginalWidth;
                if ( $desiredHeight != "*" )
                    $multY = $desiredHeight / $this->imageOriginalHeight;

                $ratio = $this->imageOriginalWidth / $this->imageOriginalHeight;

                if ( $desiredWidth == "*" )
                {
                    $newHeight = $desiredHeight;
                    $newWidth = $ratio * $desiredHeight;
                }
                elseif ( $desiredHeight == "*" )
                {
                    $newHeight = $desiredWidth / $ratio;
                    $newWidth =  $desiredWidth;
                }
                else
                {
                    if ( $mode == "-" )
                    {
                        if ( $this->imageOriginalHeight * $multX < $desiredHeight )
                        {
                            // image must be smaller than given $desired region
                            // test which multiplier gives us best result.

                            // $multX does the job
                            $newWidth = $desiredWidth;
                            $newHeight = $this->imageOriginalHeight * $multX;
                        }
                        else
                        {
                            // $multY does the job
                            $newWidth = $this->imageOriginalWidth * $multY;
                            $newHeight = $desiredHeight;
                        }
                    }
                    else
                    {
                        // mode == "+"
                        // cover the region
                        // image must be bigger than given $desired_ region
                        // test which multiplier gives us best result
                        if ( $this->imageOriginalHeight * $multX > $desiredHeight )
                        {
                            // $multX does the job
                            $newWidth = $desiredWidth;
                            $newHeight = $this->imageOriginalHeight * $multX;
                        }
                        else
                        {
                            // $multY does the job
                            $newWidth = $this->imageOriginalWidth * $multY;
                            $newHeight = $desiredHeight;
                        }
                    }
                }
                break;

            case '0':
                // fit the region exactly.
                if ( $desiredWidth == "*" )
                    $desiredWidth = $this->imageOriginalWidth;
                if ( $desiredHeight == "*" )
                    $desiredHeight = $this->imageOriginalHeight;

                $newWidth = $desiredWidth;
                $newHeight = $desiredHeight;
                break;

            default:
                return $this->error(
                    "Unknown resize mode"
                );
                break;
        } // switch

        // OK here we have $newWidth $newHeight
        // create destination image checking for GD2 functions:
        if ( $this->parameters['useGD2'] )
        {
            if ( function_exists('imagecreatetruecolor') )
            {
                $this->imageResized = imagecreatetruecolor($newWidth, $newHeight) or
                $this->error('GD2 is installed, function ImageCreateTruecolor() exists, but image is not created.');
            }
            else
            {
                $this->error(
                    "You specified to use GD2, but not all GD2 functions are present. " .
                    "ImageCreateTruecolor() not founded."
                );
            }
        }
        else
        {
            $this->imageResized = imagecreate($newWidth, $newHeight) or
            $this->error('Image is not created ImageCreate(). {GD2 suppor is OFF}');
        }

        // resize
        if ( $this->parameters['useGD2'] )
        {
            if ( function_exists('imagecopyresampled') )
            {
                $res = imagecopyresampled(
                    $this->imageResized, $this->imageOriginal,
                    0, 0,                                                 // dest coord
                    0, 0,                                                 // source coord
                    $newWidth, $newHeight,                                // dest sizes
                    $this->imageOriginalWidth, $this->imageOriginalHeight // src sizes
                ) or $this->error($hft_image_errors["GD2_NOT_RESIZED"]);

            }
            else
            {
                $this->error(
                    'GD2 is installed, function ImageCopyResampled() exists, but image is not resized'
                );
            }
        }
        else
        {
            $res = imagecopyresized(
                $this->imageResized, $this->imageOriginal,
                0, 0,                                                 // dest coord
                0, 0,                                                 // source coord
                $newWidth, $newHeight,                                // dest sizes
                $this->imageOriginalWidth, $this->imageOriginalHeight // src sizes
            ) or $this->error('Image was not resized. {GD2 suppor is OFF}');
        }

        return $this;
    }

    protected function output( $destinationFile, $imageType, $image )
    {
        $destinationFile = trim($destinationFile);
        $return = false;

        if ( $image )
        {
            switch ( $imageType )
            {
                case 'JPEG':
                case 'JPG':
                    $return = ImageJpeg(
                        $image, $destinationFile, $this->parameters['jpegQuality']
                    );
                    break;

                case 'PNG':
                    $return = ImagePng($image, $destinationFile);
                    break;

                default:
                    $this->error(
                        "The image format '$imageType' cannot be output."
                    );
                    break;
            }
        }
        else
        {
            $this->error(
                'Image you are trying to output does not exist.'
            );
        }

        if ( !( $return ) )
        {
            $this->error(
                "Unable to output '$destinationFile'."
            );
        }

        return $return;
    }

    /**
     * Output the original file
     *
     * @param string $destinationFile
     * @param string $imageType
     * @return DefinedImage
     */
    public function original( $destinationFile, $imageType = 'JPG' )
    {
        $this->output(
            $destinationFile, $imageType, $this->imageOriginal
        );

        return $this;
    }

    /**
     * Output the modified file
     *
     * @param string $destinationFile
     * @param string $imageType
     * @return DefinedImage
     */
    public function save( $destinationFile, $imageType = 'JPG' )
    {
        $return = $this->output($destinationFile, $imageType, $this->imageResized);

        if ( trim($destinationFile) )
        {
            $destinationSize = getimagesize($destinationFile);

            $this->fileResized = $destinationFile;
            $this->imageResizedWidth     = $destinationSize[0];
            $this->imageResizedHeight    = $destinationSize[1];
            $this->imageResizedTypeCode  = $destinationSize[2];
            $this->imageResizedHtmlSizes = $destinationSize[3];

            switch ( $this->imageResizedTypeCode )
            {
                case 0:
                    $this->imageResizedTypeAbbr = 'GIF';
                    break;

                case 1:
                    $this->imageResizedTypeAbbr = 'JPG';
                    break;

                case 2:
                    $this->imageResizedTypeAbbr = 'PNG';
                    break;

                case 3:
                    $this->imageResizedTypeAbbr = 'SWF';
                    break;

                default:
                    $this->imageResizedTypeAbbr = 'UNKNOWN';
                    break;
            }
        }

        return $this;
    }
}