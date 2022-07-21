<template>
  <div>
    <div class="row">
      <div 
        class="col-md-12 cover my-4"
        :style="'background-image: url(\''+ news.data.cover +'\');'"
      >

      </div>
      <div class="col-3"> &nbsp; </div>
      <div class="col-6"> 
        <h1> {{ news.data.title }} </h1>
        <p class="load" v-html="news.data.description"></p>
      </div>
      <div class="col-3"> &nbsp; </div>
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
      news: {
        description: null
      }
    }
  },
  created() {
    const id = this.$route.params.id
    
    /* Get news form ID */
    axios.get('/news/read/' + id).then((resp) => {
      this.news = resp.data
      console.log(this.news)
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