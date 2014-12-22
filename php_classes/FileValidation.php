<?php

/*
 * @class FileValidation
 * @author Jason Chen <jason@jcor.me>
 *
 * Validates file types by checking first
 * four bytes of the file.
 *
 * Current valid file types:
 *  jpeg
 *  pdf
 *  png
 *  tiff
 *  Microsoft Office documents
 */

class FileValidation
{
    protected $allowedTypes;

    protected $file;

    protected $isURL;

    /**
     * @param $file_path string The location of the file being validated; can be either a local (relative/absolute) or URL address.
     *
     * @throws FileValidationError
     */
    public function __construct($file_path)
    {
        /*
         * Check if $file_path is a URL by getting its (potential) headers
         * If the web server is configured correctly, valid URLs should ALWAYS return a 200 HTTP code.
         *
         * @todo I believe this function "breaks" and returns 301/302 on a redirect, even to a valid (redirected) URL.
         */
        $this->isURL = strpos(@get_headers($file_path)[0], '200');

        // $file_path must either be a valid local path or a valid URL.
        if (!file_exists($file_path) && $this->isURL === false)
        {
            // How are we supposed to read what doesn't exist?
            throw new FileValidationError("The file location " . $file_path . " does not exist.");
        }

        if ($this->isURL)
        {
            // Read the entire file if $file_path is a URL.
            // We can't read streams from an HTTP request (at least with PHP or C (fopen, fseek, fread) functions). I may be wrong here...
            $this->file = unpack("n*", file_get_contents($file_path));
        }
        else
        {
            // Don't read the file yet if it's a local path.
            // We CAN read streams from a local file, thus we leave it to getBytes() to decide what to read.
            $this->file = $file_path;
        }

        $this->allowedTypes = $this->getAllowedTypes();
    }

    /**
     * Validates a file's type against the allowed types by checking the first four bytes of the file.
     *
     * @throws FileValidationError
     *
     * @return string The file type/extension.
     */
    public function validateFileType()
    {
        // Convert hex to an integer
        $bytes = $this->getBytes();

        /** @noinspection PhpWrongStringConcatenationInspection */
        // Convert hex string ($bytes) to int by adding 0
        if (array_key_exists(($bytes + 0), $this->allowedTypes))
        {
            /** @noinspection PhpWrongStringConcatenationInspection */
            // Return the file type (extension) if file is valid.
            return $this->allowedTypes[($bytes + 0)];
        }
        // 14 isn't some magic number
        // It's the size for the file signature of the largest file type we allow.
        elseif (strlen($bytes) < 14 && (strlen($bytes) % 2) == 0) {
            // Each index in byte array contains 2 bytes, so we only want to iterate and call getBytes ($remainingBytes / 2) times.
            $remainingBytes = (14 - strlen($bytes)) / 2;
            // Define this outside to allow us to throw exception with correct file signature.
            $bytes = 0;

            for ($i = 1; $i <= $remainingBytes; $i++) {
                /** @noinspection PhpWrongStringConcatenationInspection */
                // Multiply $i by two because it's the number of extra bytes (+4) that we want.
                // getBytes will divide by two...
                $bytes = $this->getBytes($i * 2) + 0;

                if (array_key_exists((int) $bytes, $this->allowedTypes))
                    return $this->allowedTypes[$bytes];
            }
        }

        // @todo Throw exception here with relevant information.
        throw new FileValidationError("File with byte signature 0x" . strtoupper(base_convert($bytes, '10', '16')) . " is invalid.");
    }

    /**
     * @param int $extraBytes An integer that must be a multiple of 2 and > 0.
     * @return string
     * @throws FileValidationError
     */
    private function getBytes($extraBytes = 0)
    {
        if ($extraBytes && (($extraBytes % 2) !== 0 || !is_int($extraBytes)))
            throw new FileValidationError("Invalid number of extra bytes requested: " . $extraBytes . "; request must be an integer >= 2.");

        // Cast $this->file to array to check if it's an array.
        // $this->file is a string if we're given a local file and an array if it's an external (HTTP) file.
        if (((array) $this->file !== $this->file))
        {
            // fopen allows us to read streams (to save memory)
            $handle = fopen($this->file, 'r');
            // Read each 4 or (4 + n) bytes from the file and unpack to byte array.
            $file = unpack('n*', fread($handle, (4 + $extraBytes)));
        }
        else
        {
            /*
             * We create a copy of $this->file here if the original file path was a URL
             * Since we can't handle streams with HTTP, we have already read the entire file.
             * We're not directly referencing $this->file because if it's a local path, we
             * must keep that local path to be read again if getBytes is called again with (more) $extraBytes.
             */
            $file = $this->file;
        }

        if ($extraBytes)
        {
            // Hex string representing file signature
            $bytes = '0x';
            // Since each index in the byte array represents two bytes, we divide the number of extra bytes by two.
            $extraBytes = (4 + $extraBytes) / 2;

            for ($i = 1; $i <= $extraBytes; $i++)
            {
                $bytes .= base_convert($file[$i], '10', '16');
            }

            return $bytes;
        }

        /*
         * Each array index contains 2 bytes.
         * 0th index of the unpacked byte array is (probably...) always blank.
         * Declared separately or the resulting number will be much larger than intended.
         */
        $firstTwoBytes = $file[1];
        $secondTwoBytes = $file[2];

        /*
         * Converts the first four bytes to hex.
         * Concatenates '0x' at the beginning to denote a hex number.
         *
         * @todo Get rid of the base conversion step and concatenate the two decimal bytes. This is a temporary solution to some awkward PHP behavior while testing with decimal.
         */
        return '0x' . base_convert($firstTwoBytes, '10', '16') . base_convert($secondTwoBytes, '10', '16');
    }

    /**
     * Returns all valid file types in an associative array with the format: 'first four hex bytes => file type'.
     *
     * @return array
     *
     * @todo Find any odd behavior or valid file types with different file signatures that may exist.
     */
    private function getAllowedTypes()
    {
        $types = array(
            // JPEGs have many different file signatures, these should cover just about everything.
            0xFFD8FFDB => 'jpeg',
            0xFFD8FFE0 => 'jpeg',
            0xFFD8FFE1 => 'jpeg',
            0xFFD8FFE2 => 'jpeg',
            0xFFD8FFE3 => 'jpeg',
            0xFFD8FFE8 => 'jpeg',

            0x25504446 => 'pdf',
            0x89504E47 => 'png',

            //GIFs have either of two six-byte file signatures.
            0x474946383761 => 'gif',
            0x474946383961 => 'gif',

            // TIFFs have two different file signatures, depending on the format.
            // The first is little endian and the second is big endian.
            0x49492A00 => 'tiff',
            0x4D4D002A => 'tiff',

            // OOXML is the Microsoft Office Open XML Format.
            // Used in recent versions of Office.
            0x504B0304 => 'microsoft.ooxml',
            // PHP gets rid of leading 0 in hex when changing bases
            // Leave both just in case...
            0x504B304  => 'microsoft.ooxml',

            // OLECF is a file format used by Microsoft in earlier versions of Office (should be '97-'03).
            0xD0CF11E0 => 'microsoft.olecf',
        );

        return $types;
    }
}