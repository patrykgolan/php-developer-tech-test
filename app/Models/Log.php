<?php

namespace App\Models;


class Log
{
    private const LOG_DIR = __DIR__ . '/../logs/';
    private const LOG_TYPES = [
        1 => [
            'type' => 'credits',
            'fileName' => 'credits.log'
        ]
    ];

    private array $type;
    private string $text = '';


    public static function credits($message): void
    {
        $log = new self();
        $log->type = self::LOG_TYPES[1];
        $log->text = $message;
        $log->save();
    }

    private function save(): void
    {
        $fileName = $this->type['fileName'];
        $dir = self::LOG_DIR.$fileName;

        // check if logs exists, if not creat file
        if(!$this->checkIfLogDirectoryExists()){
            mkdir($dir, 0777, true);
        }

        $message = date("d-m-Y H:i:s").PHP_EOL.
            $this->text.PHP_EOL
            ."-------------------------".PHP_EOL;

        // add content
        file_put_contents($dir,$message, FILE_APPEND);
    }

    private function checkIfLogDirectoryExists(): bool
    {
        $dir = self::LOG_DIR;

        return file_exists($dir);
    }

}