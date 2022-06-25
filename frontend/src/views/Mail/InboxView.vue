<template>
  <div class="container">
    <DataTables
      url="mail/inbox"
      tclass="table table-bordered w-100 p-2" 
      :columns="inboxColumn"
      useNumber="1"
      useAssigner="0"
      useOpenButton="1"
      @openClicked="openMail"
      ref="inbox"
    />
  </div>  
</template>

<script>
// import axios from 'axios'
import DataTables from '../../components/DataTables.vue'

export default {
  name: 'InboxView',
  components: {
    DataTables
  },
  data() {
    return {
      inboxColumn: {
        no_surat: 'No. Surat',
        perihal: 'Perihal',
        jenis_surat: 'Jenis',
        status: 'Status',
        tanggal: 'Tanggal'
      },
    }
  },
  methods: { 
    openMail(data) {
      this.$router.push('/mail/read/' + data.no_surat)
    }
  }
}
</script>

<style>

</style>