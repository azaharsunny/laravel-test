@extends('layouts.app')
@section('content')
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
              <li class="breadcrumb-item"><a href="{{ URL::to('companies') }}">Company</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->


            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

                <div class="card-body">
                @if(Session::has('success'))
                   <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                   @elseif(Session::has('message'))
                   <div class="alert alert-danger" role="alert">{{Session::get('message')}}</div>
                @endif
                <form method="post" id="myform" enctype="multipart/form-data" action="{{ route('companies.update',$details->id) }}">
                <div id="actions" class="row">
                @method('PUT')
               @csrf
               <div class="col-md-9">
               <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" class="form-control" id="name" name="name" value="{{$details->name}}" placeholder="Name" >
               </div>
               <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" name="email" value="{{$details->email, $details->id}}" placeholder="Email Id" >
               </div>
               <div class="form-group">
                   <label for="dob">Website</label>
                   <input type="url" class="form-control" id="website" name="website" value="{{$details->website}}" placeholder="http://example.com" >
               </div>
               <div class="form-group">
                   <label for="images">Logo</label>
                   <input type="file" class="form-control" id="image" name="image" accept="image/png, image/gif, image/jpeg">
               </div>
               <div class="form-group text-center">
                   <button type="submit" class="btn btn-success">Update Company</button>
                   <a href="{{ URL::to('companies')}}" class="btn btn-primary">Back</a>
               </div>

               </div>

           </div>
                </form>
                </div>
                <!-- /.card-body -->

                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  @endsection
<!-- /.content-wrapper -->
