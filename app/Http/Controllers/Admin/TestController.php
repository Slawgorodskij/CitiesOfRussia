<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminArticleSaveRequest;
use App\Models\Article;
use App\Models\File;
use App\Models\Image;

class TestController extends Controller
{
    public function index(){
        $articles = Article::orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.test.index', ['articles' => $articles]);
    }

    public function create(){
        return view("admin.test.create", [
                'article' => new Article(),
                'is_succeed' => session('success'),
            ]
        );
    }

    public function save(AdminArticleSaveRequest $request){

        $id = $request->post('id');

        $article = $id ? Article::find($id) : new Article();

        $article->fill($request->all());

        $article->user_id = 1;

        $article->save();

        // получаем название файла и путь
        $filename = $article->title;
        // хранить файлы будем в папках с названием статьи + хэш (позже название заменю на слаг)

        $path = 'articles/' . $filename . '-' . str_replace(' ', '-', date('YmdHis'));

        // помещаем текст статьи в файл
        $text = $request->post('text');
        File::setText("$path/$filename", $text);

        $file = new File([
            'path' => "$path/$filename",
        ]);

        $article->file()->save($file);

        // сохраняем фото к статье в созданную ранее папку
        if($request->file('images')){
            foreach ($request->file('images') as $image){
                $image->store($path);
                $filename = $image->getFilename();
                $extension = $image->getClientOriginalExtension();
                $image = new Image([
                    'path' => "$path/$filename.$extension",
                ]);
                $article->images()->save($image);
            }
        }

        return redirect()->route("admin::test::index", ['article' => $article->id])
            ->with('success', "Данные сохранены");
    }

    public function update(Article $article){
        return view("admin.test.update", [
            'article' => $article,
            'text' => $article->getText($article->id)
        ]);
    }

    public function delete($id){
        Article::destroy([$id]);
        return redirect()->route("admin::test::index");
    }
}
