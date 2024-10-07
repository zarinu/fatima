<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public function index() {
        $data['breadcrumbs'] = [
            ['title' => 'صفحه اصلی', 'link' => '/'],
            ['title' => 'بلاگ'],
        ];

        $data['articles'] = Article::where('status', '<>', 'inactive')->orderByDesc('order')->get();
        return view('web.articles.index', $data);
    }

    public function show(Article $article): View
    {
        if($article->status == 'inactive') {
            return abort(403);
        }

        $article->increment('views');

        $data['breadcrumbs'] = [
            ['title' => 'صفحه اصلی', 'link' => '/'],
            ['title' => 'بلاگ', 'link' => '/articles'],
            ['title' => $article->title],
        ];

        $data['article'] = $article;
        $data['suggestion_articles'] = Article::where('status', '<>', 'inactive')->orderByDesc('order')->limit(3)->get();
//        $data['comments'] = $article->comments()
//            ->where('status', 'active')
//            ->whereNull('parent_id')
//            ->get();
        return view('web.articles.show', $data);
    }
}
