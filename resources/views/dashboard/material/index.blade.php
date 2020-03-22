@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Materials</h2>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            <a href="{{ route('materials.create') }}" class="btn btn-warning float-right">Add new</a>

            @if(count($materials) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Id</td>
                        <td>Title</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($materials as $material)
                        <tr>
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->name }}</td>
                            <td>
                                <div class="row pl-1">
                                    <a href="{{ url('dashboard/materials/' . $material->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                    <form action="{{ route('materials.destroy',$material->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                        <button onclick="return confirm('Are you sure you want to delete this material: {{ $material->title }} ?');" type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($materials) > 0)
                    <div class="pagination">
                        <?php echo $materials->render();  ?>
                    </div>
                @endif

            @else
                <i>No materials found</i>

            @endif
        </div>


@endsection
