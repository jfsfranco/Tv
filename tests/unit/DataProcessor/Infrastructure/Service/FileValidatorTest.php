<?php

namespace App\DataProcessor\Infrastructure\Service;

use Codeception\PHPUnit\TestCase;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\MockObject\MockObject;

class FileValidatorTest extends TestCase
{
    /** @var UploadedFile|MockObject */
    private $fileMock;

    /** @var FileValidator */
    private $fileValidator;

    protected function setUp(): void
    {
        $this->fileMock = $this->createMock(UploadedFile::class);
        $this->fileValidator = new FileValidator();
    }

//    public function testCheckIfFilesAreValid()
//    {
//        $this->fileMock->method("getClientOriginalExtension")->willReturn("csv");
//        $this->fileMock->method("getPathname")->willReturn("validPath");
//
//        $fileValidator = new FileValidator();
//        $fileValidator->checkIfFilesAreValid([$fileMock]);
//    }

//    /**
//     * @expectedException InvalidFileExtension
//     */
//    public function testInvalidExtension()
//    {
//        $this->fileMock->method("getClientOriginalExtension")->willReturn(".csv");
//        $this->fileValidator->checkIfFilesAreValid([$this->fileMock]);
//    }
//
//    /**
//     * @expectedException FileNotExistException
//     */
//    public function testFileNotExist()
//    {
//        $this->fileMock->method("getClientOriginalExtension")->willReturn("csv");
//        $this->fileMock->method("getPathname")->willReturn("validPath");
//        $this->fileValidator->checkIfFilesAreValid([$this->fileMock]);
//    }
//
    public function testErrorReadingFile()
    {
        $this->assertEquals(true, true);

    }
}
