<?php

class Directories
{
    public function createDirectoryAndFile($directoryName, $content)
    {
        $baseDirectory = "directories/";
        $fullDirectoryPath = $baseDirectory . $directoryName;
        $filePath = $fullDirectoryPath . "/readme.txt";

        if (!preg_match('/^[A-Za-z]+$/', $directoryName)) {
            return [
                'success' => false,
                'message' => 'Directory name must contain only alphabetic characters.',
                'path' => ''
            ];
        }

        if (is_dir($fullDirectoryPath)) {
            return [
                'success' => false,
                'message' => 'A directory already exists with that name.',
                'path' => ''
            ];
        }

        if (!mkdir($fullDirectoryPath, 0777, true)) {
            return [
                'success' => false,
                'message' => 'Error: Directory could not be created.',
                'path' => ''
            ];
        }

        if (file_put_contents($filePath, $content) === false) {
            return [
                'success' => false,
                'message' => 'Error: File could not be created.',
                'path' => ''
            ];
        }

        return [
            'success' => true,
            'message' => 'Directory and file created successfully.',
            'path' => $filePath
        ];
    }
}
