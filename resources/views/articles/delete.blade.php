@extends('articles.page')

@section('main')
    <h1>Sure you want to delete article <strong>{{ $article->name }}</strong></h1>

    <p>
        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid animi architecto, beatae cumque distinctio dolores, est fugiat hic illum, ipsa minus natus non possimus quam repellendus sunt ut. Illo, nisi.</span>
    </p>

    <form action="{{ route('articles.destroy', $article) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <div class="form-group">
            <button class="btn btn-primary">
                <i class="fas fa-trash"></i> Yes, Delete
            </button>
        </div>
    </form>
@endsection