@extends('layouts.dashboardLayout')

@section('content')

<div class="col-md-12">
    <h2>Logs</h2>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <form action="/dashboard/logs/delete_all" method="POST">
        {{ csrf_field() }}
        {{method_field('DELETE')}}
        <button onclick="return confirm('Are you sure you want to delete ALL logs?');" type="submit" class="btn btn-danger float-right mx-1">Delete ALL log</button>
    </form>

    @if(count($logs) > 0)

        <table class="table table-bordered">
            <tr>
                <td>id</td>
                <td>Log</td>
                <td>actions</td>
            </tr>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->text }}</td>
                    <td>
                        <form action="{{ route('logs.destroy',$log->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        @if(count($logs) > 0)
            <div class="pagination">
                <?php echo $logs->render();  ?>
            </div>
        @endif

    @else
        <i>No logs found</i>
    @endif
</div>

@endsection
