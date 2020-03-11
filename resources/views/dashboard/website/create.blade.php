@extends('layouts.dashboardLayout')
 
@section('content')
 
        <div class="col-md-8">
            <h2>Add Website</h2>
 
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
 
            <form method="post" action="{{ route('websites.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
 
                            <strong>Title:</strong>
 
                            <input type="text" name="title" class="form-control" />
                        </div>
                    </div>
                </div>
 
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
 
                            <strong>Url:</strong>
 
                            <input type="text" name="url" class="form-control" />
 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
 
                            <strong>Házhozszállítási árak:</strong>
 
                            <input type="text" name="delivery_prices" class="form-control" />
 
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
 
                            <strong>Egyéb infók:</strong>
 
                            <input type="text" name="other_infos" class="form-control" />
 
                        </div>
                    </div>
                </div>
 
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
 
                            <strong>Logo:</strong>
 
                            <input type="file" name="logo" class="form-control-file" />
                        </div>
                    </div>
                </div>
 
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
 
                    <button type="submit" class="btn btn-primary" id="btn-save">Create</button>
 
                </div>
 
            </form>
        </div>
 
@endsection