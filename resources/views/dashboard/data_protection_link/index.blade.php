@extends('layouts.dashboardLayout')

@section('content')

        <script>
            function scrapeAll(){
                $.notify("Scraping all, please wait.", {animate: {enter: 'animated fadeInRight',exit: 'animated fadeOutRight'}});
                axios.get('/dashboard/data_protection_links/scrapeAll')
                .then(function (response) {
                    $.notify("Scraping is done.", {animate: {enter: 'animated fadeInRight',exit: 'animated fadeOutRight'}});
                })
            }

        </script>
        <div class="col-12">
            <h2>Data protection links</h2>

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

            <a href="{{ route('data_protection_links.create') }}" class="btn btn-warning float-right mx-1">Add new</a>

            <button onclick="scrapeAll()" type="submit" class="btn btn-info float-right mx-1">Scrape All</button>

            @if(count($links) > 0)

                <table class="table table-bordered">

                    <tr>
                        <td>Url</td>
                        <td>Main Filter Selector</td>
                        <td>Website</td>
                        <td>Assigned To Category</td>
                        <td><strong>Item Schema</strong></td>
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
                                <a href="{{ url('dashboard/data_protection_links/' . $link->id . '/edit') }}"><button class="btn btn-primary" >Update</button></a>
                                <form action="{{ route('data_protection_links.destroy',$link->id) }}" method="POST" class="mb-0">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @if ($link->upToDate == 0)
                                <form action="{{ url('dashboard/data_protection_links/' . $link->id . '/readit') }}" method="POST" class="mb-0">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <button onclick="return confirm('Are you sure you read the data policy?');" type="submit" class="btn btn-success">Read It</button>
                                </form>
                                @endif
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
                <i>No Data Protection links found</i>

            @endif
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
                  url: "{{ url('dashboard/data_protection_links/set-item-schema') }}",
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
                   url: "{{ url('dashboard/data_protection_links/scrape') }}",
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
