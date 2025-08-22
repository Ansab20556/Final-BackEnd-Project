<?php
namespace App\Core;

interface Logger {
    public function log(string $message): void;
}
