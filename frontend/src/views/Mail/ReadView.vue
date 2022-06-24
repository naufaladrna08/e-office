<template>
  <div class="container">
    <div id="body" v-html="content"> </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ReadView',
  data() {
    return {
      id: this.$route.params.id,
      content: null
    }
  },
  created() {
    axios.get('/mail/read/' + this.id).then((resp) => {
      this.content = resp.data.data.description
    })
  }
}
</script>

<style>
#body {
  width: 100%;
}
</style>