@extends('app')
@section('content')
<div class="container">
 <h1>Archives</h1>
 <a href="{{url('/archives/create')}}" class="btn btn-success">Create Archive</a>
 <hr>
 <table class="table table-striped table-bordered table-hover">
   <thead>
     <tr class="bg-info">
       <th>Id</th>
       <th>Name</th>
       <th>Archive URL</th>
       <th colspan="3">Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($archives as $archive)
     <tr>
       <td>{{ $archive->id }}</td>
       <td>{{ $archive->name }}</td>
       <td>{{ $archive->archive_url }}</td>
       <td><a href="{{url('archives',$archive->id)}}" class="btn btn-primary">Show</a></td>
       <td><a href="{{route('archives.edit',$archive->id)}}" class="btn btn-warning">Edit</a></td>
       <td>
         {!! Form::open(['method' => 'DELETE', 'route'=>['archives.destroy', $archive->id]]) !!}
         {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
         {!! Form::close() !!}
       </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>
@endsection