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

class UpdateController extends Controller
{
    public function edit(Article $article): View
    {
        return view('articles.edit', compact('article'));
    }

    public function update(Article $article, Request $request): RedirectResponse
    {
        $article->fill($request->only('name', 'description'));
        $article->save();
        $this->makeMessage();
        return redirect()->route('articles.index');
    }

    private function makeMessage(): void
    {
        Message::make('Updated successfully!!', 'updated');
    }
}
