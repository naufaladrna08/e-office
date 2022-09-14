<template>
  <div class="container">
    <div id="element-to-convert">
      <div id="header" class="row mb-4">
        <div class="col-6 lead">
          <p class="lead"> <b> Kepala Surat </b> </p>
          
          <div class="row mb-2">
            <div class="col-3">
              Jenis / No / Tgl
            </div>
            <div class="col-9">
              <b> : {{ data.type }} / {{ data.mail_number }} / {{ data.updated_at }} </b>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-3">
              Perihal
            </div>
            <div class="col-9">
              <b> : {{ data.subject }} </b>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-3">
              Klasifikasi
            </div>
            <div class="col-9">
              <b> : {{ data.klasifikasi }} </b>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-3">
              Prioritas
            </div>
            <div class="col-9">
              <b> : {{ data.prioritas }} </b>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-3">
              Lampiran
            </div>
            <div class="col-9">
              <b> : {{ data.t_lampiran }} </b>
            </div>
          </div>
        </div>
        <div class="col-6 lead">
          <div class="row mb-2">
            <div class="col-md-12">
              <p class="lead"> <b> Kepada : </b> </p>
      
              <p class="lead"> {{ data.t_to }} </p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <p class="lead"> <b> Tembusan : </b> </p>
      
              <p class="lead"> {{ data.t_tembusan }} </p>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-md-12">
              <button class="btn btn-primary" @click="exportToPDF"> Download PDF </button>
            </div>
          </div>
        </div>
      </div>

      <div id="body" class="card"> 
        <div class="card-body" v-html="data.description">
          
        </div>
      </div>
    </div>

    <div id="attachments" class="card my-4">
      <div class="card-body">
        <div v-if="attachments">
          <div v-for="(item, id) in attachments" v-bind:key="id">
            <a :href="item.url" class="btn btn-secondary btn-sm"> <i class="fa fa-file"></i> {{ item.name }} </a>
          </div>
        </div>
        <div v-else> No attachment </div>
      </div>
    </div>

    <div id="log" class="card my-4" width="100%">
      <div class="card-body p-4">
        <ul v-for="(item, id) in logs" v-bind:key="id">
          <li> {{ item.description }} </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style>
  .img-fw {
    width: 100%;
    border-radius: 8px;
  }

  #log {
    color: #fff;
    background: #2d3436
  }
</style>

<script>
import axios from 'axios'
import html2pdf from "html2pdf.js"

export default { 
  name: 'ReadView',
  data() {
    return {
      id: this.$route.params.id,
      data: null,
      userdata: null,
      logs: null,
      attachments: null
    }
  },
  created() {
    axios.get('/mail/read/' + this.id).then((resp) => {
      this.data = resp.data.data
      
      axios.get('/mail/get_log?id=' + this.data.id).then((resp) => {
        this.logs = resp.data
      })

      axios.get('/mail/get_attachments?id=' + this.data.id).then((resp) => {
        this.attachments = resp.data
      })
    })

    axios.get('/mail/receiver-cc?item=' + this.id).then((resp) => {
      this.userdata = resp.data.data
    }) 
  },
  methods: {
    exportToPDF() {
      html2pdf(document.getElementById("element-to-convert"), {
        margin: 1,
        filename: "download.pdf",
      })
    }
  }
}
</script>