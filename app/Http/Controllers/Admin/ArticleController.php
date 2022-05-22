<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Sight;
use App\Models\Article;
use App\Services\UploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleFormRequest;
use App\Services\ModelService;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.articles.index', [
            'data' => Article::get([
                'id',
                'title',
                'created_at',
            ]),
            'options' => [
                'url' => "/admin/articles/",
                'fields' => [
                    [
                        'id' => 'id',
                        'name' => '#ID',
                    ],
                    [
                        'id' => 'title',
                        'name' => 'Название',
                    ],
                    [
                        'id' => 'created_at',
                        'name' => 'Дата добавления',
                    ],
                ],
                'deleteConfirmation' => "Подтвердите удаление статьи с #ID",
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $relations = [];
        foreach (app(ModelService::class)->getModelsByMethod("articles") as $modelName) {
            if (app(ModelService::class)->checkModelHasColumn($modelName, 'name')) { //костыль
                $relations[$modelName::TITLE] = $modelName::all(['id', 'name'])->toArray();
            }
        };
        return view('admin.articles.editor', ['relations' => $relations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {
        $validated = $request->validated();
        $validated['articleable_type'] = match ($validated['articleable_type']) {
            City::TITLE => City::class,
            Sight::TITLE => Sight::class,
        };
        $validated['article_body'] = app(UploadService::class)->saveText(
            $validated['article_body'],
            'articles',
        );
        $created = Article::create($validated);

        if ($created) {
            return to_route('admin.articles.index');
        }

        return back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.editor', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ArticleFormRequest $request
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleFormRequest $request, Article $article)
    {
        $validated = $request->validated();
        $validated['articleable_type'] = match ($validated['articleable_type']) {
            class_basename(City::class) => City::class,
            class_basename(Sight::class) => Sight::class,
        };
        app(UploadService::class)->saveText(
            $validated['article_body'],
            'articles',
            $article->article_body,
        );
        return to_route('admin.articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return response()->json('ok');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Article error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
