<template>
  <div>
    <div class="container py-4">
      <div id="greetings">
        <div class="card mb-4 w-100">
          <div class="card-body">
            <h1> Dashboard Admin </h1>
            <p class="lead">
              Welcome back, {{ user.name }}!
            </p>
          </div>
        </div>
      </div>

      <!-- Edit website settings -->
      <div class="row">
        <div class="col-md-6">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title my-2"> 
                <i class="fa fa-cog"></i> 
                Customize your website 
              </h5>
              
              <p class="card-text my-4"> 
                Change texts or images in Homepage such as title, descriptions, "Visi dan Misi", etc. 
              </p>

              <a href="#" class="btn btn-primary mt-4"> 
                <i class="fa fa-edit"></i>
                Customize 
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card w-100">
            <div class="card-body">
              <h5 class="card-title my-2"> 
                <i class="fa fa-plus"></i>
                Add or Remove News
              </h5>
              
              <p class="card-text my-4"> 
                Be updated and read or write some news today. You can perform CRUD on News content.   
              </p>

              <a href="#" class="btn btn-primary mt-4"> 
                <i class="fa fa-edit"></i>
                Go to page 
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import store from '../store'

export default {
  name: 'AdminView',
  data() {
    return {
      user: store.state.auth.user
    }
  }
}
</script>

<style scoped>

</style>