@extends('layouts.dashboardLayout')
 
@section('content')
 

        

        <div class="col-md-12">
            <h2>Raw Data Process</h2>
            <button class="btn btn-danger" onclick="importstuff()">Import</button>

        </div>
        
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