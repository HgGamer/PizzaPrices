@extends('layouts.dashboardLayout')
 
@section('content')
 

        <div class="col-md-12">
            <h2>Links</h2>
 
            <div class="alert alert-success" style="display: none"></div>
 
            <a href="{{ route('links.create') }}" class="btn btn-warning pull-right">Add new</a>
 
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif

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
                            <td>{{ $link->website->title }} </td>
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
                                <form action="{{ route('links.destroy',$link->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{method_field('DELETE')}}
                                    <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
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