@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 mx-auto mt-4">
                <h1>Create post</h1>
                <form action="" method="POST"> 
                    <div class="form-group has-error">
                        <label for="slug">Slug </label>
                        <input type="text" class="form-control" name="slug" />
                    
                    </div>
                    <div class="form-group">
                        <label for="title">Title </label>
                        <input type="text" class="form-control" name="title" />
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea rows="5" class="form-control" name="description" ></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection