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


}

function getMaterials(){
    $('#exampleModalLabel').html("Material fusion");
    let template = `
        <form action="api/process/joinMaterials" method="POST">
            {{ csrf_field() }}
            To: <select id="toselect" name="toselect">
            </select><br>
            From: <select id="fromselect" name="fromselect"> (esztet fogja törőni)
            </select><br><br>
            <input type="submit" class="btn btn-secondary" value="Összevonás">
        </form>
    `;
    document.getElementById('modalbody').innerHTML = template;

    axios.get('/dashboard/api/process/getmaterials')
    .then(function (response) {

        response.data.forEach(element => {
            let option = document.createElement("option");
            option.text = element.name;
            option.value = element.id;
            document.getElementById('toselect').add(option);
            let option2 = document.createElement("option");
            option2.text = element.name;
            option2.value = element.id;
            document.getElementById('fromselect').add(option2);
        });
    })
    $('#myModal').modal();

}

    </script>
@endsection
