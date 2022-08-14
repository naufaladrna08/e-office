<template>
  <div>
    <div class="row">
      <div 
        class="col-md-12 cover my-4"
        :style="'background-image: url(\''+ news.news.cover +'\');'"
      >

      </div>
      <div class="col-sm-12 col-md-3"> &nbsp; </div>
      <div class="col-sm-12 col-md-6 p-4"> 
        <h1> {{ news.news.title }} </h1>
        <p> Dibuat oleh {{ news.user.username }} </p>
        <p class="lead" v-html="news.news.description"></p>
      </div>
      <div class="col-sm-12 col-sm-3"> &nbsp; </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'NewsView',
  data() {
    return {
      cover: null,
      news: null
    }
  },
  created() {
    const id = this.$route.params.id
    
    /* Get news form ID */
    axios.get('/news/read/' + id).then((resp) => {
      this.news = resp.data.data
    })
  }
}
</script>

<style scoped>
  .cover {
    width: 100%;
    height: 200px;
    background-size: 100%;
    background-repeat: no-repeat;
    background-clip: border-box;
  }
</style>