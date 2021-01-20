<template>
<div>
 <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <nuxt-link to="" class="navbar-brand">
            <i class="fas fa-film mr-2"></i>
            Daniel Ozeh Unsplash
        </nuxt-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link nav-link-1 active" aria-current="page" href="">Photos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-link-3" href="login">Login</a>
            </li>
        </ul>
        </div>
    </div>
</nav>

<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg">
    <form class="d-flex tm-search-form">
        <input class="form-control tm-search-input" type="search" v-model="search_string" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success tm-search-btn" type="button" @click="searchByTitle();">
            <i class="fas fa-search"></i>
        </button>
    </form>
    
</div>
  
  <div class="container-fluid tm-container-content tm-mt-60">
  <div class="row">
    <div class="col-md-8">
                
              <select class="form-control">
                <option value="Test Category">Test Category</option>
                <option value="Another Category">Another Category</option>
              </select>
    </div>
    <div class="col-md-4">
      <button class="btn btn-primary">Filter</button>
    </div>

  </div>
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Latest Photos
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
              
                <form action="" class="tm-text-primary">
                    Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of 200
                </form>
            </div>
        </div>
        
        <div class="row tm-mb-90 tm-gallery">
          <template v-if="$fetchState.pending">
            <content-placeholders :rounded="true">
              <content-placeholders-img />
              <content-placeholders-heading />
            </content-placeholders>
          </template>

          <template v-else-if="$fetchState.error">An error occurred :(</template>

          <template v-else>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5" v-for="image in all_images" :key="image.id">
                  <figure class="effect-ming tm-video-item">
                      <img :src="`${ image.image_path }/${ image.file_name }`" :alt="`${ image.image_title }`" class="img-fluid" style="width: 400px; height: 250px;">
                      <figcaption class="d-flex align-items-center justify-content-center">
                          <h2>{{image.image_title}}</h2>
                          <nuxt-link :to="`image/${ image.id }`">View Details</nuxt-link>
                      </figcaption>                    
                  </figure>
                  <div class="d-flex justify-content-between tm-text-gray">
                      <span class="tm-text-gray-light">{{image.created_at}}</span>
                      <span>{{ image.image_category }}</span>
                  </div>
              </div>
            </template>
                    
        </div> <!-- row -->
        <div class="row tm-mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">
                <a href="javascript:void(0);" class="btn btn-primary tm-btn-prev mb-2 disabled">Previous</a>
                <div class="tm-paging d-flex">
                    <a href="javascript:void(0);" class="active tm-paging-link">1</a>
                    <a href="javascript:void(0);" class="tm-paging-link">2</a>
                    <a href="javascript:void(0);" class="tm-paging-link">3</a>
                    <a href="javascript:void(0);" class="tm-paging-link">4</a>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary tm-btn-next">Next Page</a>
            </div>            
        </div>
    </div> <!-- container-fluid, tm-container-content -->
    </div>
</template>

<script>
import Default from '~/components/Default.vue'
import Nav from '~/components/Nav.vue'

export default {
  components: {
    Default,
    Nav,
  },

  head() {
    return {
      title: "HomePage",
    }
  },

  data() {
    return {
      all_images: [],
      search_string: "",
    }
  },

  async fetch() {
    let res = await this.$store.dispatch('getAllImages');
    this.all_images = res.message;
  },

  methods: {
    async searchByTitle() {
      let new_images = this.$axios.post('search-image-by-title', {
        'search_string': this.search_string
      });

      console.log(new_images.response)

      this.all_images = new_images.message
    }
  }
}
</script>


