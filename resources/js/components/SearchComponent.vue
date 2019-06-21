<template>
<div>
  <div class="row">
    <div class="mx-auto col-md-6">
      <h1>Finding the perfect size for your car</h1>
      <p class="mb-4 text-body">Search by model, maker, and/or year</p>
      <form class="form-inline d-flex justify-content-center">
        <div class="input-group">
          <input type="text" class="form-control d-inline-flex justify-content-center" placeholder="Search" style="width: 350px;" id="inlineFormInputGroup" v-model="searchquery" v-on:keyup="autoComplete">
          <div class="input-group-append"><button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button></div>
          <div class="panel-footer" v-if="this.data_results.length && this.searchquery != ''">
            <ul class="list-group">
            <li class="list-group-item" v-for="result in data_results" @click="fillCarData(result.Year, result.Make, result.Model, result.Trim)"><a href="#">{{ result.Year }} {{ result.Make }} {{result.Model }} {{ result.Trim }}</a>
        </li>
      </ul>
      </div>
        </div>
      </form>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
      return {
        searchquery: '',
        data_results: [],
      };
    },
  methods: {
    autoComplete(){
    this.data_results = [];
    if(this.searchquery.length > 2){
     axios.get('/autocomplete/search',{params: {searchquery: this.searchquery}}).then(response => {
        console.log(response);
      this.data_results = response.data;
     });
    }
  },
  getVinyl() {
      axios.get('/api/makers/' + this.$root.year + '/'+ this.$root.maker + '/'+ this.$root.model +'/'+ this.$root.trim, {
          vinyls: this.$root.vinyls
      })
      .then((res) => {
              this.$root.vinyls = res.data;
      });
  },
  fillCarData(year, make, model, trim) {
    this.$root.year = year;
    this.$root.maker = make;
    this.$root.maker = make;
    this.$root.model = model;
    this.$root.trim = trim;
    this.$root.vinyls = '';
    this.getVinyl();
    this.searchquery = '';
    }
  }
}
</script>
