<?php

namespace App\Http\Controllers;

use App\DataProcessor\Application\Command\CreateScoresFromCsvCommand;
use App\DataProcessor\Application\CommandHandler\CreateScoresFromCsvCommandHandler;
use App\DataProcessor\Application\Factory\CsvProcessorErrorFactory;
use App\DataProcessor\Application\Service\FileValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Throwable;

final class CSVProcessorController extends Controller
{
    /** @var CsvProcessorErrorFactory */
    private $csvProcessorErrorFactory;

    /** @var FileValidator */
    private $fileValidator;

    /** @var CreateScoresFromCsvCommandHandler */
    private $createScoresFromCsvCommandHandler;

    public function __construct(
        FileValidator $fileValidator,
        CsvProcessorErrorFactory $csvProcessorErrorFactory,
        CreateScoresFromCsvCommandHandler $createScoresFromCsvCommandHandler
    ) {
        $this->fileValidator = $fileValidator;
        $this->csvProcessorErrorFactory = $csvProcessorErrorFactory;
        $this->createScoresFromCsvCommandHandler = $createScoresFromCsvCommandHandler;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->fileValidator->checkIfFilesAreValid($request->allFiles());

            /** @var UploadedFile $file */
            foreach ($request->allFiles() as $file) {
                $this->createScoresFromCsvCommandHandler->handle(
                    new CreateScoresFromCsvCommand($file->getPathname())
                );
            }

            return response()->json("File(s) Processed Correctly", Response::HTTP_CREATED);

        } catch (Throwable $exception) {
            return $this->csvProcessorErrorFactory->createResponseForException($exception);
        }
    }
}
