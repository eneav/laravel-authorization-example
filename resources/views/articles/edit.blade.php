@extends('articles.page')

@section('main')
    <h1>Edit article <strong>{{ $article->name }}</strong></h1>

    <form action="{{ route('articles.update', $article) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('patch') }}

        <div class=form-group>
            <label for=name>Article</label>
            <input id=name name=name type=text class=form-control value="{{ $article->name }}" required>
        </div>

        <div class=form-group>
            <label for=description>Description</label>
            <input id=description name=description type=text class=form-control value="{{ $article->description }}"
                   required>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Create
            </button>
        </div>
    </form>
@endsection