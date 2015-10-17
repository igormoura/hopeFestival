@extends('app')
@section('content')
<div class="container">
 <h1>Customers</h1>
 <a href="{{url('/customers/create')}}" class="btn btn-success">Create Application</a>
 <hr>
 {!! Form::open(array('route' => 'queries.search’, 'class'=>'form navbar-form navbar-right searchform')) !!}
 {!! Form::text('name', null, array('required', 'class'=>'form-control','placeholder'=>'Search for a tutorial...')) !!}
 {!! Form::submit('Search', array('class'=>'btn btn-default')) !!}
 {!! Form::close() !!}
 <table class="table table-striped table-bordered table-hover">
   <thead>
     <tr class="bg-info">
       <th>Id</th>
       <th>Name</th>
       <th>Document</th>
       <th>Email</th>
       <th>Phone</th>
       <th>Application/Version</th>
       <th colspan="3">Actions</th>
     </tr>
   </thead>
   <tbody>
     @foreach ($customers as $customer)
     <tr>
       <td>{{ $customer->id }}</td>
       <td>{{ $customer->name }}</td>
       <td>{{ $customer->document }}</td>
       <td>{{ $customer->email }}</td>
       <td>{{ $customer->phone }}</td>
       <td>{{ $customer->version->name }}</td>
       <td><a href="{{url('customers',$customer->id)}}" class="btn btn-primary">Show</a></td>
       <td><a href="{{route('customers.edit',$customer->id)}}" class="btn btn-warning">Edit</a></td>
       <td>
         {!! Form::open(['method' => 'DELETE', 'route'=>['customers.destroy', $customer->id]]) !!}
         {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
         {!! Form::close() !!}
       </td>
     </tr>
     @endforeach
   </tbody>
 </table>
</div>
@endsection