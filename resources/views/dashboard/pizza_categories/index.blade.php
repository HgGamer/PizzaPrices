@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Pizza categories</h2>



            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if(count($pizzaCategories) > 0)

                <table class="table table-bordered">
                    <a href="{{ route('pizza_categories.create') }}" class="btn btn-warning float-right">Add new</a>
                    <tr>
                        <td>Image</td>
                        <td>Title</td>
                        <td>Link</td>
                        <td>Order</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($pizzaCategories as $item)
                        <tr>
                            <td><img width="150" src="{{ url('img/glry/' . $item->url) }}" /></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->link }}</td>
                            <td>{{ $item->sorrend }}</td>
                            <td>
                                <a href="{{ url('dashboard/pizza_categories/' . $item->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('pizza_categories.destroy',$item->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($pizzaCategories) > 0)
                    <div class="pagination">
                        <?php echo $pizzaCategories->render();  ?>
                    </div>
                @endif

            @else
                <i>No items found</i>

            @endif
        </div>

@endsection
