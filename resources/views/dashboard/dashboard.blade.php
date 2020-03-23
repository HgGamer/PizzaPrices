@extends('layouts.dashboardLayout')

@section('content')

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-8 mb-4">
      <div class="card shadow h-100 py-1">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col">
              <div class="text-center font-weight-bold  text-uppercase  text-primary mb-1">LAST 7 DAY:</div>
              <div class="text-primary">Visitors: <span class="font-weight-bold">{{ $visitorsAndPageViews['visitors'] }}</span> </div>
              <div class="text-primary">Page loads: <span class="font-weight-bold">{{ $visitorsAndPageViews['pageViews'] }}</span></div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pizzas:</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">1000 db</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1 text-center">Proccess</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
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
        </div>
      </div>
    </div>





@endsection
