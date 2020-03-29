@extends('layouts.dashboardLayout')

@section('content')


        <div class="col-12">
            <h2>Pizza Fusion</h2>

            <button class="btn btn-info" onclick="getPizzas()">Pizza fusion</button>
            <button class="btn btn-info" onclick="getMaterials()">Material fusion</button>

            <div id="app">
                <div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel"></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body" id="modalbody">

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                </div>

            </div>

          </div>

@endsection

@section('script')
    <script>

function getPizzas(){
    $('#exampleModalLabel').html("Pizza fusion");
    let spinner =  `<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`;
    $('#modalbody').html(spinner);
    $('#myModal').modal();

}

function getMaterials(){
    $('#exampleModalLabel').html("Material fusion");
    let spinner =  `<div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>`;
    $('#modalbody').html(spinner);
    $('#myModal').modal();

}

    </script>
@endsection
