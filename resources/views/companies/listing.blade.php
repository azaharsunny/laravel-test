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
                            <li class="breadcrumb-item active">Companies</li>
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
                                <a href="{{ URL::to('companies/create') }}" class="btn btn-primary" style="float:right">+
                                    Company</a>
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
                                        <th>Logo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($companies as $company)
                                        <tr>
                                            <td>
                                                <image src="{{asset('/storage/images/logos/'.$company->logo)}}"
                                                       height="50px"></image>
                                            </td>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->email}}</td>
                                            <td>{{$company->website}}</td>

                                            <td>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <a class="btn btn-primary"  href="{{ URL::to('companies/' . $company->id . '/edit') }}">Edit</a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <form action="{{ route('companies.destroy', $company->id ) }}"
                                                              method="post">

                                                            @csrf

                                                            @method('DELETE')

                                                            <button type="submit" class=" btn btn-danger "
                                                                    onclick="return confirm('Are you sure to delete this company?')">
                                                                Delete
                                                            </button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center"> {{ $companies->links() }}</div>
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
