<?php

declare(strict_types=1);

/**
 * @author enea dhack <hello@enea.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers\Articles;

use App\Article;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreateController extends Controller
{
    public function create(): View
    {
        return view('articles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $article = $this->makeArticle($request);
        $article->save();
        $this->makeMessage();

        return redirect()->route('articles.index');
    }

    private function makeArticle(Request $request): Article
    {
        $attributes = $request->only('name', 'description');

        return new Article(array_merge($attributes, [
            'user_id' => $request->user()->getKey(),
        ]));
    }

    private function makeMessage(): void
    {
        Message::make('Saved successfully!', 'created');
    }
}
