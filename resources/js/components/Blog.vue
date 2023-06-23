<template>
    <div class="container">
      <zaglavlje></zaglavlje>
      <div class="row">
        <div class="col-6 mt-3 mb-2" v-for="item in data">
          <h3 class="text-center">{{ item.naslov }}</h3>
          <hr>
          <p>{{ item.tekst }}</p>
          <div class="card">
            <img class="card-img-top" :src="item.urlSlika" alt="slika" style="width: 100%; height: 500px">
            <div class="card-body">
              <p class="card-text"><b>Autor posta:</b> {{ item.ime }} {{ item.prezime }}</p>
              <hr>
              <p class="card-text"><b>Datum objavljivanja:</b> {{ formatDate(item.published_at) }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
    import moment from 'moment';

    export default {
        props: {
        data: Array, 
        },
        data() {
            return {
                
            }
        },
        methods: {
        formatDate(date) {
            return moment(date).format('DD.MM.YYYY');
        },
    },
  };
  
</script>
