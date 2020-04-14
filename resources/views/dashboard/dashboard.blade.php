@extends('layouts.dashboardLayout')

@section('content')

    <div class="col-xl-3 col-md-6 mb-4 ">
      <div class="card shadow h-100 py-1">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col">
              <div class="text-center font-weight-bold  text-uppercase  text-primary mb-1">LAST 7 DAY:</div>
              <div class="text-primary">Visitors: <span class="text-black font-weight-bold">{{ isset($visitorsAndPageViews7['visitors']) ? $visitorsAndPageViews7['visitors'] : "No Data" }}</span> </div>
              <div class="text-primary">Page loads: <span class="text-black font-weight-bold">{{ isset($visitorsAndPageViews7['pageViews']) ? $visitorsAndPageViews7['pageViews'] : "No Data" }}</span></div>
            </div>
          </div>
          <hr>
          <div class="row no-gutters align-items-center">
            <div class="col">
              <div class="text-center font-weight-bold  text-uppercase  text-primary mb-1">LAST 30 DAY:</div>
              <div class="text-primary">Visitors: <span class="text-black font-weight-bold">{{ isset($visitorsAndPageViews30['visitors']) ? $visitorsAndPageViews30['visitors'] : "No Data" }}</span> </div>
              <div class="text-primary">Page loads: <span class="text-black font-weight-bold">{{ isset($visitorsAndPageViews30['pageViews']) ? $visitorsAndPageViews30['pageViews'] : "No Data" }}</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Example:</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Example</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">Pizzas:</div>
                    <div class="h5 mb-0 text-info text-gray-800">Processed: <span class="text-black font-weight-bold">{{ $pizzasCount }}</span> </div>
                    <div class="h5 mb-0 text-info text-gray-800">Raw: <span class="text-black font-weight-bold">{{ $rawPizzasCount }}</span> </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card  shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col-6 text-center">
              <div class="font-weight-bold text-danger text-uppercase mb-1">Logs</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$logsCount}}</div>
            </div>
            <div class="col-6 text-center">
                <div class="font-weight-bold text-danger text-uppercase mb-1">Errors</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
              </div>
          </div>
          <hr>
        </div>
      </div>
    </div>

    <div class="container-fluid">

        <div class="row justify-content-around" style="max-height: 1000px;">

            <div class="col-12 col-xl-5">
                <div class="card  shadow h-100 ">
                    <div class="card-header text-center">
                        <H3 class="font-weight-bold">Last 5 feedback</H3>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <table class="col-12">
                            @foreach ($feedbacks as $feedback)
                            <tr><td>
                                {{  $feedback->created_at}}: <br>
                                {{  $feedback->body}}
                                <hr>
                            </td></tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                  </div>
            </div>

            <div class="col-12 col-xl-5">
                <div class="card  shadow h-100 ">
                    <div class="card-header text-center">
                        <H3 class="font-weight-bold">Sumething</H3>
                    </div>
                    <div class="card-body">
                      <div class="row align-items-center">

                        </div>
                    </div>
                  </div>
            </div>


        </div>


    </div>




@endsection
