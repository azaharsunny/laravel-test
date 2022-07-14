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
              <li class="breadcrumb-item"><a href="{{ URL::to('companies')}}">Companies</a></li>

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
                <form method="post" id="myform" enctype="multipart/form-data" action="{{ route('companies.store') }}">
                <div id="actions" class="row">
               @csrf
               <div class="col-md-9">
               <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Name" >
               </div>
               <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email Id" >
               </div>
               <div class="form-group">
                   <label for="dob">Website</label>
                   <input type="url" class="form-control" id="website" name="website" value="{{old('website')}}" placeholder="http://example.com" >
               </div>
               <div class="form-group">
                   <label for="images">Logo</label>
                   <input type="file" class="form-control" id="image" name="image" accept="image/png, image/gif, image/jpeg">
               </div>
               <div class="form-group text-center">
                   <button type="submit" class="btn btn-success">Add Company</button>
                   <a href="{{ URL::to('companies')}}" class="btn btn-primary">Back</a>
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
