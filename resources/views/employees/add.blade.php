@extends('layouts.app')
@section('content')

<style type="text/css">
  .error{
      color:red;
      font-size:12px;
  }

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ URL::to('employees')}}">Employees</a></li>

              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->




        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">{{$title}} </h3>
              </div>
              <div class="card-body">
              @if(Session::has('success'))
                   <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                   @elseif(Session::has('message'))
                   <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
                @endif
                <form method="post" id="myform" enctype="multipart/form-data" action="{{ route('employees.store') }}">
                <div id="actions" class="row">
               @csrf
               <div class="col-md-9">
               <div class="form-group">
                   <label for="first_name">First Name</label>
                   <input type="text" class="form-control" id="first_name" name="first_name" value="{{old('first_name')}}" placeholder="First Name" >
               </div>
               <div class="form-group">
                   <label for="last_name">Last Name</label>
                   <input type="text" class="form-control" id="last_name" name="last_name" value="{{old('last_name')}}" placeholder="Last Name" >
               </div>
               <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email Id" >
               </div>
               <div class="form-group">
                   <label for="phone">Phone</label>
                   <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" placeholder="XXXXXXXXXX" >
               </div>
               <div class="form-group">
                   <label for="company_id">Company</label>
                   <select name="company_id" id="company_id" class="form-control" required>
                    <option value="">Select Company</option>
                    @foreach($companies as $company)
                      <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                   </select>
               </div>
               <div class="form-group text-center">
                   <button type="submit" class="btn btn-success">Add Employee</button>
                   <a href="{{ URL::to('employees')}}" class="btn btn-primary">Back</a>
               </div>

               </div>

           </div>
                </form>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection
<!-- /.content-wrapper -->
