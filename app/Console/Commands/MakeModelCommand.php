<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand as Command;
use Illuminate\Support\Str;

class ModelMakeCommand extends Command
{
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $name = Str::replaceFirst('Database\Models\\', '', $name);
        $path = $this->laravel['path'].'/../database/Models/'.str_replace('\\', '/', $name).'.php';
        return $path;
    }

    protected function getStub()
    {
        if ($this->option('pivot')) {
            return __DIR__.'/stubs/pivot.model.stub';
        }

        return __DIR__.'/stubs/model.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return parent::getDefaultNamespace($rootNamespace) . '\Database\Models';
    }
}
