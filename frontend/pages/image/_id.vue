<template>
    <div>
    
    <div class="container-fluid tm-container-content tm-mt-60">
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
            <div class="container-fluid tm-container-content tm-mt-60">
              <div class="row mb-4">
                  <h2 class="col-12 tm-text-primary">{{ image_details.image_title }}</h2>
              </div>
              <div class="row tm-mb-90">            
                  <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                      <img :src="`${ image_details.image_path }/${ image_details.file_name }`" :alt="`${ image_details.image_title }`" class="img-fluid">
                  </div>
                  <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                      <div class="tm-bg-gray tm-video-details">
                          <p class="mb-4">
                              Please support us by making <a href="" target="_parent" rel="sponsored">a PayPal donation</a>. 
                          </p>
                          <div class="text-center mb-5">
                              <a href="#" class="btn btn-primary tm-btn-big">Download Image</a>
                          </div>                    
                          <div class="mb-4 d-flex flex-wrap">
                              
                              <div class="mr-4 mb-2">
                                  <span class="tm-text-gray-dark">Category: </span><span class="tm-text-primary">{{ image_details.image_category }}</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div> <!-- container-fluid, tm-container-content -->
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
      title: "Image Details",
    }
  },

  data() {
    return {
      image_details: [],
      page_id: this.$route.params.id
    }
  },

  async fetch() {
    var page_id = this.page_id;
    let res = await this.$axios.$get('/view-image-by-id?id=' + page_id);
    this.image_details = res.message;
  }
}
</script>


