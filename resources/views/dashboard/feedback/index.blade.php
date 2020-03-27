@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Feedbacks</h2>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if(count($feedbacks) > 0)
            <form action="/dashboard/feedbacks/delete_all" method="POST">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button onclick="return confirm('Are you sure you want to delete ALL feedbacks?');" type="submit" class="btn btn-danger float-right mx-1">Delete ALL log</button>
            </form>

                <table class="table table-bordered">
                    <tr>
                        <td>Text</td>
                        <td>Date</td>
                    </tr>
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->body }}</td>
                        </tr>
                    @endforeach
                </table>

                @if(count($feedbacks) > 0)
                    <div class="pagination">
                        <?php echo $feedbacks->render();  ?>
                    </div>
                @endif

            @else
                <i>No feedbacks found</i>

            @endif
        </div>


@endsection
