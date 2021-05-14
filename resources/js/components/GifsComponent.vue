<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Trending GIFs</b></div>

                <div class="card-body">

                  <!-- The Search Form -->
                    <form @submit.prevent="searchGifs()">
                    <div class="input-group mb-3">
                        <input v-model="search" type="text" class="form-control" placeholder="type your search here" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button type="submit" class="btn btn-primary" id="basic-addon2">search GIFs</button>
                      </div>
                    </form>

                  <!-- The GIFs Table -->
                    <table class="table">
                        <thead>
                          <tr>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item, rowIndex) in 5" :key="rowIndex">
                            <td v-for="(item, colIndex) in counter" :key="colIndex">
                              <img :src="calcGifIndex(rowIndex, colIndex)" class="img-thumbnail" alt="">
                            </td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
            
            <!-- The Pagination Nav -->
            <nav aria-label="Page navigation example" class="mt-1">
              <ul class="pagination">
                <li v-on:click="loadMoreResults($event)" v-for="(i, index) in getCount" :key="index" :class="{'page-item':1, 'active':currentPage==i}"><a :class="{'page-link':1, 'active':currentPage==i}" href="#">{{i}}</a></li>
              </ul>
            </nav>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {

            this.loadGifs(); // load trending GIFs at start up
        },

        computed: {
          getGifs () {
                    return this.gifs;
                  },
          getCount () {
                    return this.count;
          }
        },

        data(){
           return {
             gifs: null,
             search: null,
             offset: 0,
             counter: [1,2,3,4,5,6], // the number of columns per page
             count: 0,
             currentPage: null
           }
        },

        methods: {
            
            // load trending GIFs
            loadGifs(){
              axios.get(`/api/gifs`)
                 .then(response => { 
                                     this.gifs = response.data.data;
				        });
            },

            // search GIFs
            searchGifs(){ 
               
               axios.get(`/api/gifs/search?search=${this.search}&offset=0`)
                 .then(response => { let res = response.data;
                                     this.count = res.count%36==0 ? Math.floor(res.count/36) : Math.floor(res.count/36)+1
                                     this.gifs = res.data;
                                     this.currentPage = 1
				        });
            },

            // get the GIF URL from the returned GIFs JSON data for each table cell 
            calcGifIndex(rowIndex, colIndex){ 
               let index = rowIndex * 6 + colIndex;
              if(this.gifs[index])
               return this.getGifs[index].images.downsized.url; 
            },

            // load GIF results for the selected search page
            loadMoreResults(e){  
                this.currentPage = e.target.innerText               
                this.offset = (e.target.innerText-1)*36
                axios.get(`/api/gifs/search?search=${this.search}&offset=${this.offset}`)
                 .then(response => {  let res = response.data;
                                     this.gifs = res.data;
				        });
            }
        
    }
    }
</script>

<style scoped>
/* a class to disable the currently active page link */
.active{
  background-color: blue;
  cursor: auto;
  pointer-events:none;
}

</style>