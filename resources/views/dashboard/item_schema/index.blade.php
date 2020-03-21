@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Item Schema</h2>

            <a href="{{ route('item-schema.create') }}" class="btn btn-warning float-right">Add new</a>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if(count($itemSchemas) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Title</td>
                        <td>Size</td>
                        <td>CSS Expression</td>
                        <td>Is Full Url To Pizza</td>
                        <td>Full content selector</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($itemSchemas as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->pizza_size }}</td>
                            <td>{{ $item->css_expression }}</td>
                            <td>{{ $item->is_full_url==1?"Yes":"No" }}</td>
                            <td>{{ $item->full_content_selector }}</td>
                            <td>
                                <a href="{{ url('dashboard/item-schema/' . $item->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('item-schema.destroy',$item->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($itemSchemas) > 0)
                    <div class="pagination">
                        <?php echo $itemSchemas->render();  ?>
                    </div>
                @endif

            @else
                <i>No items found</i>

            @endif
        </div>

@endsection
