<template>
  <div class="container">
    <div id="header" class="row">
      <div class="col-6 lead">
        <p class="lead"> <b> Kepala Surat </b> </p>
        
        <div class="row mb-2">
          <div class="col-4">
            Jenis / No / Tgl
          </div>
          <div class="col-8">
            <b> : {{ data.type }} / {{ data.mail_number }} / {{ data.updated_at }} </b>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-4">
            Perihal
          </div>
          <div class="col-8">
            <b> : {{ data.subject }} </b>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-4">
            Klasifikasi Masalah
          </div>
          <div class="col-8">
            <b> : {{ data.klasifikasi_masalah }} </b>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-2">
            Lampiran
          </div>
          <div class="col-2">
            <b> : {{ data.type }} </b>
          </div>
          <div class="col-2">
            Prioritas
          </div>
          <div class="col-2">
            <b> : {{ data.priority }} </b>
          </div>
          <div class="col-2">
            Klasifikasi
          </div>
          <div class="col-2">
            <b> : {{ data.klasifikasi }} </b>
          </div>
        </div>
      </div>
      <div class="col-6 lead">
        <div class="row mb-2">
          <div class="col-md-12">
            <p class="lead"> <b> Penerima : </b> </p>
    
            <ul v-for="(item) in userdata.receiver" v-bind:key="item">
              <li> {{ item.name }} </li>
            </ul>
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-md-12">
            <p class="lead"> <b> CC : </b> </p>

            <ul v-for="(item) in userdata.cc" v-bind:key="item">
              <li> {{ item.name }} </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div id="body" class="card"> 
      <div class="card-body" v-html="data.description">
        
      </div>
    </div>

    <div id="log" class="card mt-4">
      <div class="card-body p-4">
        <ul v-for="(item, id) in logs" v-bind:key="id">
          <li> {{ item.description }} </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default { 
  name: 'ReadView',
  data() {
    return {
      id: this.$route.params.id,
      data: null,
      userdata: null,
      logs: null
    }
  },
  created() {
    axios.get('/mail/read/' + this.id).then((resp) => {
      this.data = resp.data.data
      
      axios.get('/mail/get_log?id=' + this.data.id).then((resp) => {
        this.logs = resp.data
      })   
    })

    axios.get('/mail/receiver-cc?item=' + this.id).then((resp) => {
      this.userdata = resp.data.data
    }) 
  }
}
</script>

<style>
#body {
  width: 100%;
}

#log {
  color: #fff;
  background: #2d3436
}
</style>