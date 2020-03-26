@extends('layouts.dashboardLayout')

@section('content')


        <div class="col-md-12">
            <h2>Update Pizza Category #{{$pizzaCategory->id}}</h2>

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

            <form method="post" action="{{ route('pizza_categories.update', $pizzaCategory->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field("PUT") }}

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Title:</strong>

                            <input type="text" name="name" value="{{ $pizzaCategory->name }}" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Link:</strong>

                            <input type="text" name="link" value="{{ $pizzaCategory->link }}" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">

                            <strong>Sorrend:</strong>

                            <input type="text" name="sorrend" value="{{ $pizzaCategory->sorrend }}" class="form-control" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                    @if($pizzaCategory->url != "")
                        <img src="{{ url('img/glry/' . $pizzaCategory->url) }}" width="150" />
                    @endif
                        <div class="form-group">

                            <strong>Image:</strong>

                            <input type="file" name="url" class="form-control-file" />
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                    <button type="submit" class="btn btn-primary" id="btn-save">Update</button>

                </div>

            </form>
        </div>


@endsection
