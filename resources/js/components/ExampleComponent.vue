<template>
<div class="form-group">
  <div>
    <input type="text" placeholder="what are you looking for?" v-model="searchquery" v-on:keyup="autoComplete" class="form-control">
    <div class="panel-footer" v-if="data_results.length && searchquery != ''">
      <ul class="list-group">
      <li class="list-group-item" v-for="result in data_results" @click="fillCarData(result.Year, result.Make, result.Model, result.Trim)"><a href="#">{{ result.Year }} {{ result.Make }} {{result.Model }} {{ result.Trim }}</a>
  </li>
</ul>
</div>
</div>
<div class="row">
  <div class="col-md-3">
  <h2 class="">Year</h2>
  <select class="browser-default custom-select" v-model="year" @change="getMakers()">
    <option selected value ="0">Select Year</option>
    <option v-for="year in years" :value='year.Year'>{{ year.Year }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Make</h2>
  <select class="browser-default custom-select" v-model="maker" @change="getModels()">
    <option selected value ="0">Select Maker</option>
    <option v-for="maker in makers" :value='maker.Make'>{{ maker.Make }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Model</h2>
  <select class="browser-default custom-select" v-model="model" @change="getTrims()">
    <option selected value ="0">Select Model</option>
    <option v-for="model in models" :value='model.Model'>{{ model.Model }}</option>
  </select>
  </div>
  <div class="col-md-3">
  <h2 class="">Trim</h2>
  <select class="browser-default custom-select" v-model="trim" @change="getVinyl()">
  <option selected value ="0">Select Trim</option>
    <option v-for="trim in trims" :value='trim.Trim'>{{ trim.Trim }}</option>
  </select>
  </div>
  </div>
  <div class="container mt-5" v-if="vinyls != ''">
    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center pb-2">Vinyl Wrap&nbsp;<small class="text-muted"><br>The length of the vinyl wrap needed is an approximation based on skilled level</small></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-bordered ">
            <thead class="thead-dark">
              <tr>
                <th>Tier List (Skill level)</th>
                <th>Approximate Length (in Feet)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Novice</th>
                <td>{{ vinyls[0] }} ft</td>
              </tr>
              <tr>
                <th>Intermediate</th>
                <td>{{ vinyls[1] }} ft</td>
              </tr>
              <tr>
                <th scope="row" contenteditable="true">Professional</th>
                <td>{{ vinyls[2] }} ft</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>
</template>
<script type="text/javascript">
export default {
    props: ['initialYears'],
    data() {
        return {
            years: _.cloneDeep(this.initialYears),
            year: 0,
            makers: '',
            maker: 0,
            models: '',
            model: 0,
            trims: '',
            trim: 0,
            vinyls: '',
            searchquery: '',
            data_results: [],
        };
    },
    methods: {
        getYears() {
            axios.get('/api/years/', {
                years: this.years
            })
            .then((res) => {
                    this.years = res.data;
                    this.makers = '';
                    this.maker = 0;
                    this.models = '';
                    this.model = 0;
                    this.trim = 0;
                    this.vinyls = '';
            });
        },
        getMakers() {
            axios.get('/api/makers/' + this.year, {
                makers: this.makers
            })
            .then((res) => {
                    this.makers = res.data;
                    this.maker = 0;
                    this.models = '';
                    this.model = 0;
                    this.trims = '';
                    this.trim = 0;
                    this.vinyls = '';
            });
        },
        getModels() {
            axios.get('/api/makers/' + this.year + '/'+ this.maker, {
                models: this.models
            })
            .then((res) => {
                    this.models = res.data;
                    this.model = 0;
                    this.trims = '';
                    this.trim = 0;
                    this.vinyls = '';
            });
        },
        getTrims() {
            axios.get('/api/makers/' + this.year + '/'+ this.maker + '/'+ this.model, {
                trims: this.trims
            })
            .then((res) => {
                    this.trims = res.data;
                    this.vinyls ='';
            });
        },
        getVinyl() {
            axios.get('/api/makers/' + this.year + '/'+ this.maker + '/'+ this.model +'/'+ this.trim, {
                vinyls: this.vinyls
            })
            .then((res) => {
                    this.vinyls = res.data;
            });
        },
        autoComplete(){
        this.data_results = [];
        if(this.searchquery.length > 2){
         axios.get('/autocomplete/search',{params: {searchquery: this.searchquery}}).then(response => {
            console.log(response);
          this.data_results = response.data;
         });
        }
      },
      fillCarData(year, make, model, trim) {
        this.year = year;
        this.maker = make;
        this.model = model;
        this.trim = trim;
        this.getVinyl();
        this.searchquery = '';
      }
    }
}
</script>
