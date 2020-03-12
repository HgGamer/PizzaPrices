<template>
    <div>
        <h2>Raw Data Process</h2>
        <button class="btn btn-danger" onclick="importstuff()">Import</button>
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
}
</script>
