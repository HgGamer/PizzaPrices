@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Websites</h2>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif


                <a href="{{ route('websites.create') }}" class="btn btn-warning float-right">Add new</a>
                <form action="{{ url('/dashboard/storedatas/delete/-1') }}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button onclick="return confirm('Are you sure you want to delete the pizzas for all restaurant?');" type="submit" class="btn btn-danger">Delete ALL StoreData</button>
                </form>

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
                                <form action="{{ url('/dashboard/storedatas/delete/'. $website->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete the pizzas for {{ $website->title }}?');" type="submit" class="btn btn-danger">Delete StoreData</button>
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
