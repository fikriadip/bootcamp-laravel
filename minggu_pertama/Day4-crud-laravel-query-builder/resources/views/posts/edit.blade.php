@extends('partial.master')

@section('content')

<div class="ml-3 mt-3">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Data {{$edit->id}}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/crud/posts/{{$edit->id}}" method="POST">
            @csrf
            @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{$edit->title}}" placeholder="Masukkan Title">
              @error('title')
              <div class="alert alert-danger">{{ $message }}</div>
          @enderror
            </div>
            <div class="form-group">
              <label for="body">Body</label>
              <input type="text" class="form-control" id="body" name="body" value="{{$edit->body}}" placeholder="Masukkan Body">
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
