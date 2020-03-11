@extends('layouts.dashboardLayout')
 
@section('content')

        <div class="col-md-12">
            <h2>Websites</h2>
 
            <a href="{{ route('websites.create') }}" class="btn btn-warning pull-right">Add new</a>
 
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if(count($websites) > 0)
 
                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>Logo</td>
                        <td>Url</td>
                        <td>Delivery Prices</td>
                        <td>Other infos</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($websites as $website)
                        <tr>
                            <td>{{ $website->title }}</td>
                            <td><img width="150" src="{{ url('uploads/' . $website->logo) }}" /></td>
                            <td><a href="{{ $website->url }}">{{ $website->url }}</a> </td>
                            <td>{{ $website->delivery_prices }}</td>
                            <td>{{ $website->other_infos }}</td>
                            <td>
                                <a href="{{ url('dashboard/websites/' . $website->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('websites.destroy',$website->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
 
                @if(count($websites) > 0)
                    <div class="pagination">
                        <?php echo $websites->render();  ?>
                    </div>
                @endif
 
            @else
                <i>No websites found</i>
 
            @endif
        </div>

 
@endsection