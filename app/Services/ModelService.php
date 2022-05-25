<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class ModelService
{
    public function getAvailableModels(): array
    {
        $models = [];
        $modelsPath = app_path('Models');
        $modelFiles = File::allFiles($modelsPath);
        foreach ($modelFiles as $modelFile) {
            $models[] = '\App\Models\\' . $modelFile->getFilenameWithoutExtension();
        }
        return $models;
    }

    public function getModelsByMethod(string $methodName): array
    {
        return array_filter(
            $this->getAvailableModels(),
            fn ($model) => method_exists($model, $methodName)
        );
    }

    public function checkModelHasColumn(string $modelName, string $column): bool
    {
        return Schema::hasColumn($modelName::TABLE, $column);
    }
}