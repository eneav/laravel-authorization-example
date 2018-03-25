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
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DeleteController extends Controller
{
    public function delete(Article $article): View
    {
        return view('articles.delete', compact('article'));
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->drop($article);
        $this->makeMessage($article);
        return redirect()->route('articles.index');
    }

    protected function makeMessage(Article $article): void
    {
        Message::make("Article {$article->getKey()} was eliminated", 'deleted');
    }

    private function drop(Article $article): bool
    {
        try {
            return $article->delete() === true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
