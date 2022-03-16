<?php

namespace App\Services\Implementations;

use App\Services\Contracts\UploadFileServiceContract;
use Exception;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadFileService implements UploadFileServiceContract
{
    public function run(UploadedFile $file, string $directory, string $name = "", string $disk = "local")
    {
        try {
            $fileName = $name;
            $fileOriginalName = $file->getClientOriginalName();
            $fileOriginalExtension = $file->getClientOriginalExtension();

            if (!$name) {
                $fileName = uniqid(str_replace("." . $fileOriginalExtension, "", $fileOriginalName));
                $fileName = $fileName . ".$fileOriginalExtension";
            }
            $filePath = "$directory/$fileName";
            $fileContents = file_get_contents($file);

            if (!Storage::disk($disk)->put($filePath, $fileContents)) {
                throw new Exception("Nao foi possivel fazer o upload de imagem");
            }
            return $fileName;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
