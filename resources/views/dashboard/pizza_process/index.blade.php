@extends('layouts.dashboardLayout')

@section('content')



<div class="col-md-12">
    <h2>Raw Data Process</h2>
    <h3>Processálandó kiválasztása</h3>

    <form action="api/process/setProcessID" method="POST">
        {{ csrf_field() }}
        <select id="processID" name="processID">
            @foreach ($sites as $site)
                <option value="{{$site->id}}" {{ $site->id == $processid ? 'selected' : '' }}>{{$site->title}}</option>
            @endforeach
        </select>
        <input type="submit" class="btn btn-secondary" value="Mentés">
    </form>


    <button class="btn btn-danger" onclick="importstuff()">Import</button>

    <div id="app">
        <process></process>
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
    <button class="btn btn-danger" onclick="getAllMaterials()">getAllMaterials</button>
    <div id="allmaterials">
    </div>


</div>



<script>

function unknownPizza(data){
    let template = `
    <p>Imeretlen pizza, <b>${data.data}</b>, ez a név jó ? </p>
    <p>Alapanyagok: <b>${data.receptreadable}</b></p>
    <form action="api/process/newPizza" method="POST">
            {{ csrf_field() }}
            <input type="text" id="errordata" name="errordata" value="${data.data}" style="display:none">
            <input type="text" name="recept" value="${data.recept}" style="display:none">
            <input type="text" id="rawid" name="rawid" value="${data.rawid}" style="display:none">
            <input type="submit" class="btn btn-secondary" value="Hozzáadás új pizzának">
        </form>
    <form action="api/process/newPizzaAlias" method="POST">
            {{ csrf_field() }}
            <label for="newalias">Már létező pizza</label><br>
            <input type="text" id="errordata" name="errordata" value="${data.data}" style="display:none">
            <input type="text" id="recept" name="recept" value="${data.recept}" style="display:none">
            <input type="text" id="rawid" name="rawid" value="${data.rawid}" style="display:none">
            <select id="newalias" name="newalias" >
            </select><br>
            <input type="submit" class="btn btn-secondary" value="Kiválasztottal egyezik">
        </form><br>

    `;
    document.getElementById('modalbody').innerHTML = template;
    console.log(data);
    axios.get('/dashboard/api/process/getpizzas')
    .then(function (response) {

        response.data.forEach(element => {
            let option = document.createElement("option");
            option.text = element.name;
            option.value = element.id;
            document.getElementById('newalias').add(option);
        });
    })
}


function unknownMaterial(data){
    let template = `
        <p>Imeretlen alapanyag, <b>${data.data}</b>, már létezővel egyezik, vagy új? </p>
        <form action="api/process/newMaterialAlias" method="POST">
            {{ csrf_field() }}
            <label for="newalias">Már létező alapanyag</label><br>
            <input type="text" id="errordata" name="errordata" value="${data.data}" style="display:none">
            <select id="newalias" name="newalias" >
            </select><br><br>
            <input type="submit" class="btn btn-secondary" value="Kiválasztottal egyezik">
        </form><br>
        <form action="api/process/newMaterial" method="POST">
            {{ csrf_field() }}
            <input type="text" id="errordata" name="errordata" value="${data.data}" style="display:none">
            <input type="submit" class="btn btn-secondary" value="Hozzáadás új alapnyagnak">
        </form>
    `;
    document.getElementById('modalbody').innerHTML = template;

    axios.get('/dashboard/api/process/getmaterials')
    .then(function (response) {

        response.data.forEach(element => {
            let option = document.createElement("option");
            option.text = element.name;
            option.value = element.id;
            document.getElementById('newalias').add(option);
        });
    })

}

function showDialog(data){
    if(data == undefined){
        alert("we are done");
    }
    if(data.message == "unknown material"){
        unknownMaterial(data);
    }
    if(data.message == "unknown pizza"){
        unknownPizza(data);
    }
    console.log(data);
    $('#myModal').modal();
}

function importstuff(){
axios.get('/dashboard/api/process')
  .then(function (response) {
    showDialog(response.data[0]);
  })
}


function getAllMaterials(){
    document.getElementById('allmaterials').innerHTML = "<h3>Loading..</h3>";
    axios.get('/dashboard/api/process/getAllNewMaterial').then(function (response) {
        template = "";
        template = `<table class='table'><thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">Acton</th></tr></thead><tbody>`;
        for (let i = 0; i < response.data.length; i++) {
            template += "<tr>";
            template += `<th scope='row'>${i}</th>`;
            template += `<td>${response.data[i]}</td>`;
            template += `<td><button>add</button></td>`;
            template += "<tr>";
        }
        template += "</tbody></table>";
        document.getElementById('allmaterials').innerHTML = template;
    })
}
</script>


@endsection
