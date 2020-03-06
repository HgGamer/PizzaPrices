@extends('layouts.dashboardLayout')t')
 
@section('content')
 
        <div class="col-md-6">
            <h2>Update Pizza Type #{{$pizzaType->id}}</h2>
 
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
 
            <form method="post" action="{{ route('pizza-types.update', ['id' => $pizzaType->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field("PUT") }}
 
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
 
                            <strong>Title:</strong>
 
                            <input type="text"  name="title" value="{{ $pizzaType->title }}" class="form-control" />
                        </div>
                    </div>
                </div>
 
                <div class="row">
                   
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @if($pizzaType->image != "")
                        <img src="{{ url('uploads/' . $pizzaType->image) }}" width="150" />
                        @endif

                        <div class="form-group">
 
                            <strong>Logo:</strong>

                            <input type="file" name="logo" class="form-control-file" />
                        </div>
                    </div>
                </div>
 
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
 
                    <button type="submit" class="btn btn-primary" id="btn-save">Update</button>
 
                </div>
 
            </form>
        </div>
 
@endsection