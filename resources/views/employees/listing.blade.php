@extends('layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active">Employees</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
                <a href="{{ URL::to('employees/create') }}" class="btn btn-primary" style="float:right">+ Employee</a>
              </div>
               @if(Session::has('success'))
                   <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                   @elseif(Session::has('message'))
                   <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
                @endif
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                  @foreach($employees as $employee)
                  <tr>
                    <td>{{$employee->first_name}}</td>
                    <td>{{$employee->last_name}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->phone}}</td>
                    <td>{{$employee->company->name}}</td>

                    <td>
                        <div class="row">
                            <div class="col-md-4">
                                <a class="btn btn-primary" href="{{ URL::to('employees/' . $employee->id . '/edit') }}">Edit</a>
                            </div>
                            <div class="col-md-4">
                                <form action="{{ route('employees.destroy', $employee->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class=" btn btn-danger" onclick="return confirm('Are you sure to delete this employee?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
             <div class="text-center"> {{ $employees->links() }}</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
<!-- /.content-wrapper -->
