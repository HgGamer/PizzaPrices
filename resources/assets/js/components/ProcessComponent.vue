<template>
    <div>
        <br>

        <h2>New Material</h2>

        <div>
            <form v-on:submit.prevent="postNewMaterial">
            <input type="text" id="AliasMakerinput">
            <button @click="postNewMaterial" class="btn btn-danger">Add</button>
            </form>
        </div>



    </div>
</template>

<script lang="ts">
import Vue from "vue"
import Component from "vue-class-component"
import axios from  "axios"

@Component
export default class Process extends Vue {
    data () {
    return {
      msg: 'Hello'
    }
  }
  public postNewMaterial(): void {
    let data = (<HTMLInputElement>document.getElementById('AliasMakerinput')!).value;
    (<HTMLInputElement>document.getElementById('AliasMakerinput')!).value = "";

    axios.post('api/process/newMaterial', {
        errordata: data,
    })
    .then(function (response) {

        console.log(response);
    })

  }
}
</script>
