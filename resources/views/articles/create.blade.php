@extends('articles.page')

@section('main')
    <h1>Create Article</h1>

    <form action="{{ route('articles.store') }}" method="POST">
        {{ csrf_field() }}

        <div class=form-group>
            <label for=name>Article</label>
            <input id=name name=name type=text class=form-control required>
        </div>

        <div class=form-group>
            <label for=description>Description</label>
            <input id=description name=description type=text class=form-control required>
        </div>

        <div class="form-group">
            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Create
            </button>
        </div>
    </form>
@endsection