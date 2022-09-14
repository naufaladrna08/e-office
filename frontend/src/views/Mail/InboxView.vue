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
      @deleteClicked="deleteMail"
      ref="inbox"
    />
  </div>  
</template>

<script>
import axios from 'axios'
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
    },
    deleteMail(data) {
      let id = data.no_surat

      this.$swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post('/mail/delete', {
          id: id
          }).then((resp) => {
            if (resp.data.status == "Success") {
              this.$swal.fire({
                icon: 'success',
                title: 'All good.',
                text: 'Data has been deleted!'
              })

              /* Refresh */
              this.$refs.inbox.fetchData()
            } else {
              this.$swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong! Please try again later.'
              })
            }
          })
        }
      })
    }
  }
}
</script>

<style>

</style>