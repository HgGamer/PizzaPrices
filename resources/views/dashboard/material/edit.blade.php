@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-8">
            <h2>Update Material #{{$material->id}}</h2>

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

            <form method="post" action="{{ route('materials.update', $material->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field("PUT") }}

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Title:</strong>

                            <input type="text" name="name" value="{{ $material->name }}" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    @if($material->img != "")
                        <img src="{{ url('img/feltetek/' . $material->img) }}" width="150" />
                    @endif
                        <div class="form-group">

                            <strong>Image:</strong>

                            <input type="file" name="img" class="form-control-file" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    @if($material->gen_img != "")
                        <img src="{{ url('img/generated_assets/' . $material->gen_img) }}" width="150" />
                    @endif
                        <div class="form-group">

                            <strong>Generated Image:</strong>

                            <input type="file" name="gen_img" class="form-control-file" />
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button type="submit" class="btn btn-primary" id="btn-save">Update</button>

                </div>

            </form>
        </div>

@endsection
