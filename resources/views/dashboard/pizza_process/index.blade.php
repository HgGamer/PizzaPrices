@extends('layouts.dashboardLayout')

@section('content')



<div class="col-md-12">

    <div id="app">
        <process></process>


    </div>



</div>



<script>


function unknownMaterial(data){
    let template = `
        <p>Imeretlen alapanyag, <b>${data.data}</b>, már létezővel egyezik, vagy új? </p>
        <form action="api/process/newMaterialAlias" method="POST">
            {{ csrf_field() }}
            <label for="newalias">Már létező alapanyag</label><br>
            <input type="text" id="errordata" name="errordata" value="${data.data}" style="display:none">
            <select id="newalias" name="newalias" >
            </select><br>
            <input type="submit" value="Kiválasztottal egyeziks">
        </form><br>
        <form action="api/process/newMaterial" method="POST">
            {{ csrf_field() }}
            <input type="text" id="errordata" name="errordata" value="${data.data}" style="display:none">
            <input type="submit" value="Hozzáadás új alapnyagnak">
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
    if(data.message == "unknown material"){
        unknownMaterial(data);
    }
    console.log(data);
    $('#myModal').modal()
}

function importstuff(){
axios.get('/dashboard/api/process')
  .then(function (response) {
    showDialog(response.data[0]);
  })
}
</script>



@endsection
