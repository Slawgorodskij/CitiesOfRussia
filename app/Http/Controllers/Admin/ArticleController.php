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
        return view(
            'admin.articles.editor',
            ['relations' => app(ModelService::class)->getRelationsByMethod("articles", ['id', 'name'])]
        );
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

        try {
            $articleable = app(ModelService::class)
                ->getModelNameSpaceByTitle($validated['articleable_type'])
                ::find($validated['articleable_id']);

            $articles = [
                new Article([
                    'article_body' => app(UploadService::class)->saveText(
                        $validated['article_body'],
                        'articles',
                    ),
                    'user_id' => $validated['user_id'],
                    'title' => $validated['title'],
                    'description' => $validated['description'],
                ])
            ];
            $articleable->articles()->saveMany($articles);

            return to_route('admin.articles.index');
        } catch (\Exception $e) {
            return back()->withInput();
        }
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
            'relations' => app(ModelService::class)->getRelationsByMethod("articles", ['id', 'name']),
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
        unset($validated['articleable_type']);
        $validated['article_body'] = app(UploadService::class)->saveText(
            $validated['article_body'],
            'articles',
            $article->article_body,
        );
        $updated = $article->fill($validated)->save();
        if ($updated) {
            return to_route('admin.articles.index');
        }
        return back()->withInput();
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
