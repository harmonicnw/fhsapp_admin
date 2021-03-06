<?php

namespace Tests;

define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__ . '/php_classes/FileValidation.php');
require_once(__ROOT__ . '/php_classes/FileValidationError.php');

use FileValidation;

/** @noinspection PhpUndefinedClassInspection */
class FileValidationTest extends \PHPUnit_Framework_TestCase
{
    const TEST_FILE_DIRECTORY = __ROOT__ . '/tests/assets/file_validation/';

    /**
     * @expectedException \FileValidationError
     */
    public function testExceptionIsRaisedForInvalidFile()
    {
        (new FileValidation(static::TEST_FILE_DIRECTORY . 'a_fake_gif.gif'))->validateFileType();
    }

    public function testCanValidateGIF()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_gif.gif');

        $this->assertEquals('gif', $validate->validateFileType());
    }

    public function testCanValidatePNG()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_png.png');

        $this->assertEquals('png', $validate->validateFileType());
    }

    public function testCanValidateJPEG()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_jpeg.jpg');

        $this->assertEquals('jpeg', $validate->validateFileType());
    }

    public function testCanValidateTIFF()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_tiff.tif');

        $this->assertEquals('tiff', $validate->validateFileType());
    }

    public function testCanValidateMSFTDOCX()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_docx.docx');

        $this->assertEquals('microsoft.ooxml', $validate->validateFileType());
    }

    public function testCanValidateMSFTPPTX()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_pptx.pptx');

        $this->assertEquals('microsoft.ooxml', $validate->validateFileType());
    }

    public function testCanValidateMSFTXLSX()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_xlsx.xlsx');

        $this->assertEquals('microsoft.ooxml', $validate->validateFileType());
    }

    public function testCanValidateMSFTDoc()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_doc.doc');

        $this->assertEquals('microsoft.olecf', $validate->validateFileType());
    }

    public function testCanValidateMSFTPPT()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_ppt.ppt');

        $this->assertEquals('microsoft.olecf', $validate->validateFileType());
    }

    public function testCanValidateMSFTXLS()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_xls.xls');

        $this->assertEquals('microsoft.olecf', $validate->validateFileType());
    }

    public function testCanValidatePDF()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_pdf.pdf');

        $this->assertEquals('pdf', $validate->validateFileType());
    }

    /**
     * @expectedException \FileValidationError
     */
    public function testCanValidateDisallowingPDFFileType()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_pdf.pdf');
        $validate->disallowFileType('pdf');
        $validate->validateFileType();
    }

    /**
     * @expectedException \FileValidationError
     */
    public function testCanValidateDisallowingPDFFileSignature()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_pdf.pdf');
        $validate->disallowFileSignature(0x25504446);
        $validate->validateFileType();
    }

    public function testCanValidateDynamicallyAllowingRBFileType()
    {
        $validate = new FileValidation(static::TEST_FILE_DIRECTORY . 'a_rb.rb');
        // I don't believe this is the actual file signature for rb files, if they have one at all.
        // Just testing the allowFileType() function here...
        $validate->allowFileType(0x72657175, 'ruby');

        $this->assertEquals('ruby', $validate->validateFileType());
    }
}