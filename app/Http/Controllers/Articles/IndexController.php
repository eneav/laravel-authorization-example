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
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(): View
    {
        return view('articles.index', [
            'user' => auth()->user(),
            'articles' => Article::query()->orderBy('id', 'desc')->paginate(10),
        ]);
    }
}
