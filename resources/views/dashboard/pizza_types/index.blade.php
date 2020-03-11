@extends('layouts.dashboardLayout')
 
@section('content')
 

        <div class="col-md-12">
            <h2>Pizza Types</h2>
 
            <a href="{{ route('pizza-types.create') }}" class="btn btn-warning pull-right">Add new</a>
    
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if(count($pizzaTypes) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                    </tr>
                    @foreach($pizzaTypes as $pizzaType)
                        <tr>
                            <td>{{ $pizzaType->title }}</td>
                            <td><img width="150" src="{{ url('uploads/' . $pizzaType->image) }}" /></td>
                            <td>
                                <a href="{{ url('dashboard/pizza-types/' . $pizzaType->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('pizza-types.destroy',$pizzaType->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
 
                @if(count($pizzaTypes) > 0)
                    <div class="pagination">
                        <?php echo $pizzaTypes->render();  ?>
                    </div>
                @endif
 
            @else
                <i>No pizza types found</i>
 
            @endif
        </div>
 
@endsection