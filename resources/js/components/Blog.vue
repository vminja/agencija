<template>
    <div class="container">
      <div class="row">
        <div class="col-6 mt-3 mb-2" v-for="item in data">
          <h3 class="text-center">{{ item.naslov }}</h3>
          <!-- <hr>
          <p class="text-center">{{ item.opis }}</p> -->
          <div class="card">
            <a :href="`/blog/prikaziIzabraniBlog/${item.id}`" type="button">
              <img class="card-img-top" :src="item.urlSlika" alt="slika" style="width: 100%; height: 500px">
            </a>
            <div class="card-body">
              <p class="card-text"> 
                
                
                <!-- <a :href="`/adminPanel/blog/prikaziIzabraniBlog/${item.id}`" type="button" class="btn btn-success">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"></path>
                  </svg>
                </a> &nbsp; -->
                <b>Autor posta:</b> {{ item.ime }} {{ item.prezime }}
              </p>
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
