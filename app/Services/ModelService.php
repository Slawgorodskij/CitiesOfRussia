<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
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

    public function getModelsNameSpaceByMethod(string $methodName): array
    {
        return array_filter(
            $this->getAvailableModels(),
            fn ($model) => method_exists($model, $methodName)
        );
    }

    public function checkModelHasColumns(string $modelName, array $columns): bool
    {
        foreach ($columns as $column) {
            if (!Schema::hasColumn($modelName::TABLE, $column)) {
                return false;
            }
        }
        return true;
    }

    public function getModelNameSpaceByTitle(string $title): string|false
    {
        foreach ($this->getAvailableModels() as $model) {
            if ($model::TITLE == $title) {
                return $model;
            }
        }
        return false;
    }

    public function getRelationsByMethod(string $methodName, array $columns): array
    {
        $relations = [];
        foreach ($this->getModelsNameSpaceByMethod($methodName) as $modelName) {
            if ($this->checkModelHasColumns($modelName, $columns)) {
                $relations[$modelName::TITLE] = $modelName::all($columns)->toArray();
            }
        };
        return $relations;
    }
}
