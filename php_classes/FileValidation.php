<?php

/*
 * @class FileValidation
 * @author Jason Chen <jason@jcor.me>
 *
 * Validates file types by checking a
 * file's byte signature.
 *
 * Current valid file types:
 *  jpeg
 *  pdf
 *  gif
 *  png
 *  tiff
 *  Microsoft Office documents
 */

class FileValidation
{
    /**
     * An (associative) array of all the allowed file types in the format: 'file signature' => 'file type'
     *
     * @var array
     */
    protected $allowedTypes;

    /**
     * The local path of the file being validated or the byte array of a file from the internet (if a URL is provided).
     *
     * @var string|array
     */
    protected $file;

    /**
     * The file being validated is a URL (on the internet).
     *
     * @var bool
     */
    protected $isURL;

    /**
     * The largest (strlen) file signature of all valid file types.
     *
     * @var int
     */
    protected $largestFileSignature;

    /**
     * @param $file_path string The location of the file being validated; can be either a local (relative/absolute) or URL address.
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
        $this->isURL = strpos(@get_headers($file_path)[0], '200') ? true : false;

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
            // We CAN read streams from a local file, so we leave it to getBytes() to decide what to read.
            $this->file = $file_path;
        }

        $this->allowedTypes = $this->getAllowedTypes();
        $this->setLargestFileSignature();
    }

    /**
     * Validates a file's type against the allowed types by checking the file's (file) signature.
     *
     * @throws FileValidationError
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
        // It's the size for the largest file signature of all the file types we allow.
        elseif (strlen($bytes) < $this->largestFileSignature) {
            // Each index in byte array contains 2 bytes, so we only want to iterate and call getBytes ($remainingBytes / 2) times.
            $remainingBytes = ($this->largestFileSignature - strlen($bytes)) / 2;

            for ($i = 1; $i <= $remainingBytes; $i++) {
                /** @noinspection PhpWrongStringConcatenationInspection */
                // Multiply $i by two because it's the number of extra bytes (+4) that we want.
                $bytes = $this->getBytes($i * 2) + 0;

                if (array_key_exists((int) $bytes, $this->allowedTypes))
                    return $this->allowedTypes[$bytes];
            }
        }

        // @todo Throw exception here with relevant information.
        throw new FileValidationError("File with byte signature 0x" . strtoupper(base_convert($bytes, '10', '16')) . " is invalid.");
    }


    /**
     * Dynamically add a new file type to the array of already allowed types.
     *
     * @param $fileSignature int Hex number representing the file type's byte signature.
     * @param $fileType string A string identifying the file type being added.
     * @return void
     * @throws FileValidationError
     */
    public function allowFileType($fileSignature, $fileType)
    {
        // PHP loves to auto convert all hex numbers to decimal...
        $hexString = base_convert($fileSignature, '10', '16');

        // We should always get an even number of bytes >= 2
        if (!is_int($fileSignature) || ((strlen($hexString) % 2) !== 0))
            throw new FileValidationError("The file signature " . $fileSignature . " is invalid. It must be a hex number and contain an even number of bytes >= 2.");

        $this->allowedTypes[$fileSignature] = $fileType;
        $this->setLargestFileSignature();
    }

    /**
     * Disallows a currently allowed file type (by file type); otherwise, has no effect.
     *
     * @param $fileType string A string identifying the file type to be disallowed.
     * @return int Returns 1 if a file type was disallowed, 0 if it's not a currently allowed type.
     *
     * @todo Breaking DRY here with this and disallowFileSignature()
     */
    public function disallowFileType($fileType)
    {
        // Multiple file signatures may identify the same file type, so we keep count here if > 1 is removed.
        $removed = 0;
        // We store all file type strings in lowercase.
        $fileType = strtolower($fileType);

        foreach ($this->allowedTypes as $fileSignature => $allowedType)
        {
            if ($allowedType === $fileType)
                unset($this->allowedTypes[$fileSignature]);
                $removed++;
        }

        // Return the number of types removed if we removed anything.
        if ($removed)
            return $removed;

        return 0;
    }

    /**
     * Disallows a currently allowed file type by file signature); otherwise, has no effect.
     *
     * @param $fileSignature int Hex number representing the file signature of the file type to be disallowed.
     * @return int Returns 1 if a file type was disallowed, 0 if it's not a currently allowed type.
     *
     * @todo Breaking DRY here with this and disallowFileType()
     */
    public function disallowFileSignature($fileSignature)
    {
        foreach ($this->allowedTypes as $keyFileSignature => $allowedType)
        {
            if ($keyFileSignature === $fileSignature)
            {
                unset($this->allowedTypes[$keyFileSignature]);
                // There cannot be two identical keys, so we can safely say the requested file signature has been disallowed.
                return 1;
            }
        }

        return 0;
    }

    /**
     * Get an array of all allowed file types without signatures.
     *
     * @return array
     */
    public function allowedFileTypes()
    {
        $types = array();

        foreach ($this->allowedTypes as $allowedType)
        {
            $types[] = $allowedType;
        }

        return $types;
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
            // Since each index in the byte array represents two bytes, we divide the number of bytes we want by two.
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
     * Returns all valid file types in an associative array with the format: 'file (byte) signature => file type'.
     *
     * @return array
     *
     * @todo Find any odd behavior or valid file types with different file signatures that may exist.
     * @todo A load of different file types seem to share a similar signature to OOXML (e.g. ZIP files have 0x504B0304)...we need a reliable way to handle, especially since I've added the ability to dynamically add file types.
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
            0x504B030414000600 => 'microsoft.ooxml',
            // PHP gets rid of leading 0 in hex when changing bases
            // Leave both just in case...
            0x504B3041400600  => 'microsoft.ooxml',

            // OLECF is a file format used by Microsoft in earlier versions of Office (should be '97-'03).
            0xD0CF11E0 => 'microsoft.olecf',
        );

        return $types;
    }

    /**
     * Iterates through all allowed file types and finds and sets the largest file signature.
     *
     * @return void
     */
    private function setLargestFileSignature()
    {
        foreach ($this->allowedTypes as $fileSignature => $allowedType)
        {
            if (strlen($fileSignature) > $this->largestFileSignature)
                $this->largestFileSignature = strlen($fileSignature);
        }
    }
}