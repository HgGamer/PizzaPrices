@extends('layouts.dashboardLayout')

@section('content')
 
        <div class="col-md-6">
            <h2>Categories</h2>
 
            <a href="{{ route('categories.create') }}" class="btn btn-warning pull-right">Add new</a>
 
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
 
            @if(count($categories) > 0)
 
                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($categories as $cat)
                        <tr>
                            <td>{{ $cat->title }}</td>
                            <td>
                                <a href="{{ url('dashboard/categories/' . $cat->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('categories.destroy',$cat->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
 
                @if(count($categories) > 0)
                    <div class="pagination">
                        <?php echo $categories->render();  ?>
                    </div>
                @endif
 
            @else
                <i>No categories found</i>
 
            @endif
        </div>
 
@endsection