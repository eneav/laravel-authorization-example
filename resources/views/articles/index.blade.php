@extends('articles.page')

@section('main')

    <h1>Articles</h1>

    @include('articles.partials.messages')

    <div class="action-buttons text-right">
        <a class="btn btn-primary" href="{{ route('articles.create') }}">
            <i class="fas fa-plus-square"></i> New Article
        </a>
    </div>

    <br>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Article</th>
            <th class="d-none d-lg-block">Description</th>
            <th class="text-center"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->name }}</td>
                <td class="d-none d-lg-block">{{ $article->description }}</td>

                {{-- options --}}
                <td class="text-right">
                    @authenticatedCan('modify-articles')
                        <a class="btn btn-sm btn-warning"
                           href="{{ route('articles.edit', $article) }}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    @endauthenticatedCan

                    @authenticatedCan('destroy-articles')
                        <a class="btn btn-sm btn-danger"
                           href="{{ route('articles.delete', $article) }}">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    @endauthenticatedCan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="table-paginator">
        {{ $articles->render() }}
    </div>
@endsection