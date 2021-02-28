@extends('partial.master')

@push('style')
<link rel="stylesheet" href="{{asset('Admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">    
@endpush
@section('title')
    Static Tables
@endsection
@section('content')
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Tables</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
                <a href="{{ route('crudposts.create')}}" class="btn btn-primary mb-3">Create New Data</a>
                <div class="table-responsive">
              <table class="table table-bordered" id="posts">
                <thead align="center">
                  <tr>
                    <th style="width: 2%;">No</th>
                    <th style="width: 40%;">Title</th>
                    <th style="width: 40%;">Body</th>
                    <th style="width: 15%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key=>$value)
                    <tr>
                        <th class="text-center">{{$key + 1}}</th>
                        <td>{{$value->title}}</td>
                        <td>{{$value->body}}</td>
                        <td>
                            <form action="crudposts/{{$value->id}}" method="POST" style="text-align: center">
                                <a href="{{ route('crudposts.show',$value->id)}}" class="btn btn-info btn-m mr-2"><i class="fa fa-clipboard"></i></a>
                                <a href="{{ route('crudposts.edit',$value->id)}}" class="btn btn-primary btn-m mr-2"><i class="fa fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-m mr-2"><i class="fa fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>            
              </table>
            </div>
            </div>
            <!-- /.card-body -->
          </div>
          <script src='https://kit.fontawesome.com/a076d05399.js'></script>
          @push('script')
      
  <script src="{{asset('Admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('Admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script>
  $(() => {
    $("#posts").DataTable();
  });
</script>
  @endpush
        @endsection
