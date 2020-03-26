@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Add Pizza Category</h2>

            @if(session('error')!='')
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (count($errors) > 0)

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="post" action="{{ route('pizza_categories.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Title:</strong>

                            <input type="text" name="name" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Link:</strong>

                            <input type="text" name="link" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Order:</strong>

                            <input type="text" name="sorrend" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Img:</strong>

                            <input type="file" name="url" class="form-control-file" />
                        </div>
                    </div>
                </div>



                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button type="submit" class="btn btn-primary" id="btn-save">Create</button>

                </div>

            </form>
        </div>

@endsection
