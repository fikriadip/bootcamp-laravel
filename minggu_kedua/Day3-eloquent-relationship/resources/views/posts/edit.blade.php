@extends('partial.master')

@section('content')

<div class="ml-3 mt-3">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">id Data {{$tag->id}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/crudposts/{{$tag->id}}" method="POST">
            @csrf
            @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{$tag->title}}" placeholder="Masukkan Title">
              @error('title')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <input type="text" class="form-control" id="body" name="body" value="{{$tag->body}}" placeholder="Masukkan Body">
              @error('body')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
            </div>
          </div>
          <!-- /.card-body -->
    
          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update Data</button>
          </div>
        </form>
      </div>
    </div>
@endsection
