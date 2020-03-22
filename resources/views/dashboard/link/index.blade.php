@extends('layouts.dashboardLayout')

@section('content')


        <div class="col-12">
            <h2>Links</h2>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

            @if ($message = Session::get('danger'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
            @endif

            <a href="{{ route('links.create') }}" class="btn btn-warning float-right mx-1">Add new</a>
            <form action="/dashboard/raw_pizzas/delete_all" method="POST">
                {{ csrf_field() }}
                {{method_field('DELETE')}}
                <button onclick="return confirm('Are you sure you want to delete ALL raw pizzas?');" type="submit" class="btn btn-danger float-right mx-1">Delete ALL raw pizzas</button>
            </form>

            @if(count($links) > 0)

                <table class="table table-bordered">

                    <tr>
                        <td>Url</td>
                        <td>Main Filter Selector</td>
                        <td>Website</td>
                        <td>Assigned To Category</td>
                        <td><strong>Item Schema</strong></td>
                        <td><strong>Scrape Link</strong></td>
                        <td>Actions</td>
                    </tr>
                    @foreach($links as $link)
                        <tr data-id="{{ $link->id }}">
                            <td>{{ $link->url }}</td>
                            <td>{{ $link->main_filter_selector }}</td>
                            <td>{{ $link->website->title }}#{{ $link->website->id }}</td>
                            <td><strong><span class="label label-info">{{ $link->category->title }}</span></strong> </td>
                            <td>
                                <select class="item_schema" data-id="{{ $link->id }}" data-original-schema="{{$link->item_schema_id}}">
                                    <option value="" disabled selected>Select</option>
                                    @foreach($itemSchemas as $item)
                                        <option value="{{$item->id}}" {{ $item->id==$link->item_schema_id?"selected":"" }}>{{$item->title}}</option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-info btn-sm btn-apply" style="display: none">Apply</button>
                            </td>
                            <td>
                                @if($link->item_schema_id != "" && $link->main_filter_selector != "")
                                    <button type="button" class="btn btn-primary btn-scrape" title="pull the latest items">Scrape <i class="fas fa-spinner fa-spin" style="display: none"></i></button>
                                @else
                                    <span style="color: red">fill main filter selector and item schema first</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('dashboard/links/' . $link->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('links.destroy',$link->id) }}" method="POST" class="mb-0">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <form action="/dashboard/raw_pizzas/{{$link->website_id}}/delete_pizzas" method="POST" class="mb-0">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete raw pizzas for website: {{$link->website->title}} ?');" type="submit" class="btn btn-danger">Delete&nbspraw&nbsppizzas</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>

                @if(count($links) > 0)
                    <div class="pagination">
                        <?php echo $links->render();  ?>
                    </div>
                @endif

            @else
                <i>No links found</i>

            @endif
        </div>

        <div class="col-md-12">

            <table class="table table-bordered">
                <h2>Static data</h2>
                <tr>
                    <td>Url</td>
                    <td>Leiras</td>
                    <td>Website</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Actions</td>
                </tr>
                    <tr >
                        <td>http://banyaicukraszda.hu/</td>
                        <td>A feltétek megadása a banyai pizzéria pizzáihoz</td>
                        <td>Bányai cukrászda#26</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <form action="/dashboard/raw_pizzas/banyai_load" method="POST" class="mb-0">
                                {{ csrf_field() }}
                                <button  type="submit" class="btn btn-info">Banyai toppings load</button>
                             </form>
                    </td>
                    </tr>
                </tr>
                <tr >
                    <td>https://forzaitalia.hu/</td>
                    <td>A forza Italia Pizzak feltöltése</td>
                    <td>Forza Italia#29</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <form action="/dashboard/raw_pizzas/forzaitalia_load" method="POST" class="mb-0">
                            {{ csrf_field() }}
                            <button  type="submit" class="btn btn-info">ForzaItalia pizzas load</button>
                         </form>
                </td>
                </tr>
            </table>

          </div>

@endsection

@section('script')
    <script>
        $(function () {
           $("select.item_schema").change(function () {
              if($(this).val() != $(this).attr("data-original-schema")) {
                  $(this).siblings('.btn-apply').show();
              }
           });

           $('.btn-apply').click(function () {

               var btn = $(this);

               var tRowId = $(this).parents("tr").attr("data-id");
               var schema_id = $(this).siblings('select').val();

               $.ajaxSetup({
                   headers: {
                       'X-XSRF-TOKEN': "{{ csrf_token() }}"
                   }
               });

               $.ajax({
                  url: "{{ url('dashboard/links/set-item-schema') }}",
                  data: {link_id: tRowId, item_schema_id: schema_id, _token: "{{ csrf_token() }}", _method: "patch"},
                  method: "post",
                  dataType: "json",
                  success: function (response) {
                      alert(response.msg);

                      btn.hide();
                  }
               });
           });

           $(".btn-scrape").click(function () {
               var btn = $(this);

               btn.find(".fa-spin").show();

               btn.prop("disabled", true);

               var tRowId = $(this).parents("tr").attr("data-id");

               $.ajaxSetup({
                   headers: {
                       'X-XSRF-TOKEN': "{{ csrf_token() }}"
                   }
               });

               $.ajax({
                   url: "{{ url('dashboard/links/scrape') }}",
                   data: {link_id: tRowId, _token: "{{ csrf_token() }}"},
                   method: "post",
                   dataType: "json",
                   success: function (response) {

                       if(response.status == 1) {
                           $(".alert").removeClass("alert-danger").addClass("alert-success").text(response.msg).show();
                       } else {
                           $(".alert").removeClass("alert-success").addClass("alert-danger").text(response.msg).show();
                       }

                       btn.find(".fa-spin").hide();
                   }
               });
           });
        });
    </script>
@endsection
