@extends('layouts.dashboardLayout')

@section('content')

        <div class="col-md-12">
            <h2>Pizzas</h2>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if(count($pizzas) > 0)

                <table class="table table-bordered">
                    <tr>
                        <td>Id</td>
                        <td>Title</td>
                        <td>Pizza Category</td>
                        <td>Pizza Category2</td>
                        <td>Pizza Category3</td>
                        <td>Actions</td>
                    </tr>
                    @foreach($pizzas as $pizza)
                        <tr  data-id="{{ $pizza->id }}">
                            <td>{{ $pizza->id }}</td>
                            <td>{{ $pizza->name }}</td>
                            <td>
                                <select class="pizza_category" data-id="{{ $pizza->id }}" data-original-category="{{{ isset($pizza['pizzaCategory']) ? $pizza['pizzaCategory']['id'] : 0 }}}">
                                    <option value="0" selected>NO CATEGORY YET</option>
                                    @foreach($pizzaCategories as $category)
                                        <option value="{{$category->id}}" {{ $category->id==(isset($pizza['pizzaCategory']) ? $pizza['pizzaCategory']['id'] : 0)  ? "selected" : "" }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-info btn-sm btn-apply" style="display: none">Apply</button>
                            </td>
                            <td>
                                <select class="pizza_category2" data-id="{{ $pizza->id }}" data-original-category="{{{ isset($pizza['pizzaCategory2']) ? $pizza['pizzaCategory2']['id'] : 0 }}}">
                                    <option value="0" selected>NO CATEGORY YET</option>
                                    @foreach($pizzaCategories as $category)
                                        <option value="{{$category->id}}" {{ $category->id==(isset($pizza['pizzaCategory2']) ? $pizza['pizzaCategory2']['id'] : 0)  ? "selected" : "" }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-info btn-sm btn-apply2" style="display: none">Apply</button>
                            </td>
                            <td>
                                <select class="pizza_category3" data-id="{{ $pizza->id }}" data-original-category="{{{ isset($pizza['pizzaCategory3']) ? $pizza['pizzaCategory3']['id'] : 0 }}}">
                                    <option value="0" selected>NO CATEGORY YET</option>
                                    @foreach($pizzaCategories as $category)
                                        <option value="{{$category->id}}" {{ $category->id==(isset($pizza['pizzaCategory3']) ? $pizza['pizzaCategory3']['id'] : 0)  ? "selected" : "" }}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-info btn-sm btn-apply3" style="display: none">Apply</button>
                            </td>
                            <td>
                                <div class="row pl-1">
                                    <a href="{{ url('dashboard/pizzas/' . $pizza->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                    <form action="{{ route('pizzas.destroy',$pizza->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                        <button onclick="return confirm('Are you sure you want to delete this pizza: {{ $pizza->title }} ?');" type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <a  onclick="showMaterials('{{ $pizza->name }}','{{ $pizza->recept }}')"><button class="btn btn-success" >Materials</button></a>
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

            <div class="modal" tabindex="-1" role="dialog" id="materials-modal">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal-title"> </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" >
                        <p id="materials-modal-body"></p>
                    </div>
                  </div>
                </div>
              </div>
        </div>


@endsection

@section('script')
    <script>
        $(function () {
           $("select.pizza_category").change(function () {
              if(($(this).val() != $(this).attr("data-original-category")) && $(this).val() != 0 ){
                  $(this).siblings('.btn-apply').show();
              }else if (($(this).val() == $(this).attr("data-original-category")) ||  $(this).val() == 0){
                  $(this).siblings('.btn-apply').hide();
              }
           });

           $("select.pizza_category2").change(function () {
              if(($(this).val() != $(this).attr("data-original-category")) && $(this).val() != 0 ){
                  $(this).siblings('.btn-apply2').show();
              }else if (($(this).val() == $(this).attr("data-original-category")) ||  $(this).val() == 0){
                  $(this).siblings('.btn-apply2').hide();
              }
           });

           $("select.pizza_category3").change(function () {
              if(($(this).val() != $(this).attr("data-original-category")) && $(this).val() != 0 ){
                  $(this).siblings('.btn-apply3').show();
              }else if (($(this).val() == $(this).attr("data-original-category")) ||  $(this).val() == 0){
                  $(this).siblings('.btn-apply3').hide();
              }
           });

           $('.btn-apply').click(function () {

               var btn = $(this);

               var pizzaId = $(this).parents("tr").attr("data-id");
               var category_id = $(this).siblings('select').val();

               $.ajaxSetup({
                   headers: {
                       'X-XSRF-TOKEN': "{{ csrf_token() }}"
                   }
               });

               $.ajax({
                  url: "{{ url('dashboard/pizzas/set-pizza-category') }}",
                  data: {pizza_id: pizzaId, category_id: category_id, _token: "{{ csrf_token() }}", _method: "patch"},
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

             $('.btn-apply2').click(function () {

                var btn = $(this);

                var pizzaId = $(this).parents("tr").attr("data-id");
                var category_id2 = $(this).siblings('select').val();

                $.ajaxSetup({
                    headers: {
                        'X-XSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ url('dashboard/pizzas/set-pizza-category2') }}",
                    data: {pizza_id: pizzaId, category_id2: category_id2, _token: "{{ csrf_token() }}", _method: "patch"},
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

            $('.btn-apply3').click(function () {

                var btn = $(this);

                var pizzaId = $(this).parents("tr").attr("data-id");
                var category_id3 = $(this).siblings('select').val();

                $.ajaxSetup({
                    headers: {
                        'X-XSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $.ajax({
                    url: "{{ url('dashboard/pizzas/set-pizza-category3') }}",
                    data: {pizza_id: pizzaId, category_id3: category_id3, _token: "{{ csrf_token() }}", _method: "patch"},
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
