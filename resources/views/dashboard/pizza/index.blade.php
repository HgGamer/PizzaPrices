@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Pizzas</h2>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <a href="{{ route('pizzas.create') }}" class="btn btn-warning float-right">Add new</a>

            @if(count($pizzas) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Id</td>
                        <td>Title</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($pizzas as $pizza)
                        <tr>
                            <td>{{ $pizza->id }}</td>
                            <td>{{ $pizza->name }}</td>
                            <td>
                                <div class="row pl-1">
                                    <a href="{{ url('dashboard/pizzas/' . $pizza->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                    <form action="{{ route('pizzas.destroy',$pizza->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                        <button onclick="return confirm('Are you sure you want to delete this pizza: {{ $pizza->title }} ?');" type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($pizzas) > 0)
                    <div class="pagination">
                        <?php echo $pizzas->render();  ?>
                    </div>
                @endif

            @else
                <i>No pizzas found</i>

            @endif
        </div>


@endsection
