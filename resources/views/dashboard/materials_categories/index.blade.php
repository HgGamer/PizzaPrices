@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Materials categories</h2>



            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if(count($materialsCategories) > 0)

                <table class="table table-bordered">
                    <a href="{{ route('materials_categories.create') }}" class="btn btn-warning float-right">Add new</a>
                    <tr>
                        <td>Title</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($materialsCategories as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ url('dashboard/materials_categories/' . $item->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('materials_categories.destroy',$item->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($materialsCategories) > 0)
                    <div class="pagination">
                        <?php echo $materialsCategories->render();  ?>
                    </div>
                @endif

            @else
                <i>No items found</i>
                <a href="{{ route('materials_categories.create') }}" class="btn btn-warning float-right">Add new</a>
            @endif
        </div>

@endsection
