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
                        <td>Image</td>
                        <td>Material Category</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($materials as $material)
                        <tr data-id="{{ $material->id }}">
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->name }}</td>
                            <td><img width="150" src="{{ url('img/feltetek/' . $material->img) }}" /></td>
                            <td>
                                <select class="materials_category" data-id="{{ $material->id }}" data-original-category="{{{ isset($material['category_id']) ? $material['category_id'] : 0 }}}">
                                    <option value="0" selected>NO CATEGORY YET</option>
                                    @foreach($materialsCategories as $category)
                                        <option value="{{$category->id}}" {{ $category->id==(isset($material['category_id']) ? $material['category_id'] : 0)  ? "selected" : "" }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-info btn-sm btn-apply" style="display: none">Apply</button>
                            </td>
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

@section('script')
    <script>
        $(function () {
            $("select.materials_category").change(function () {
                if(($(this).val() != $(this).attr("data-original-category")) && $(this).val() != 0 ){
                    $(this).siblings('.btn-apply').show();
                }else if (($(this).val() == $(this).attr("data-original-category")) ||  $(this).val() == 0){
                    $(this).siblings('.btn-apply').hide();
                }
            });

            $('.btn-apply').click(function () {

                var btn = $(this);

                var materialId = $(this).parents("tr").attr("data-id");
                var category_id = $(this).siblings('select').val();



                $.ajaxSetup({
                    headers: {
                        'X-XSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ url('dashboard/material/set-material-category') }}",
                    data: {materials_id: materialId, category_id: category_id, _token: "{{ csrf_token() }}", _method: "patch"},
                    method: "post",
                    dataType: "json",
                    success: function (response) {
                        $.notify(response.msg, {animate: {enter: 'animated fadeInRight',exit: 'animated fadeOutRight'}});
                        btn.hide();
                    },
                    error: function (request, status, error) {
                        alert(request.responseText);
                    }
                });
            });

        });

        function showMaterials(pizzaName, feltetekOBJ){
            //var feltetek = $.parseJSON(feltetekOBJ);
            console.log("call")
            $.ajax({
                url: "{{ url('dashboard/materials/by_ids') }}",
                data: {feltetek: feltetekOBJ,  _token: "{{ csrf_token() }}"},
                method: "get",
                dataType: "json",
                success: function (response) {

                    feltetekSTRING = ""
                    response.feltetek.forEach(element => {
                        feltetekSTRING = feltetekSTRING + element  + ", "
                    });

                    $('#materials-modal-body').html(feltetekSTRING)
                    $('#modal-title').html(pizzaName + ":")
                    $('#materials-modal').modal();

                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });

        }
    </script>
@endsection
