
  
@extends('partial.master')
@section('title')
    Show Data
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Tables</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <a href="{{'/crud/posts/create'}}" class="btn btn-primary mb-3">Create New Data</a>
    
    <div class="table-responsive">
    <table class="table table-bordered">
    <thead class="text-center">
        <tr>
        <th style="width: 2%;">No</th>
        <th style="width: 30%;">Title</th>
        <th style="width: 30%;">Body</th>
        <th style="width: 10%">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
    @foreach ($show as $data)
        <th class="text-center">{{$loop->iteration}}</th>
        <td>{{$data->title}}</td>
        <td>{{$data->body}}</td>
        <td align="center">
            <a href="/crud/posts" class="btn btn-primary btn-m">Back</a>
        </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
    </div>
</div>
@endsection