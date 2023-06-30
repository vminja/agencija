<template>
    <div>
 
        <form class="border p-4 rounded m-4" method="POST" enctype="multipart/form-data">
    
            <!-- <select disabled id="inputState" name="id" class="form-control" v-model="id">
                <option v-for="item in data" :value="item.id">{{ item.id }}</option>
            </select> -->

            <div class="col mb-3 mt-3">
                <label for="inputState">ID posta: </label>
                <label v-for="d in data">{{ d.id }}</label>
            </div>
           
            <div class="col mb-3 mt-3">
                <label for="inputState">Naslov</label>
                <input required type="text" class="form-control" name="naslov" placeholder="Unesite naslov posta" v-model="naslov" >
            </div>

            <div class="col mb-3 mt-3">
                <label for="inputState">Opis</label> 
                <input required type="text" class="form-control" name="opis" placeholder="Unesite opis posta" v-model="opis">
            </div>
            
            <div class="col mb-3 mt-3">
                <label for="inputState">Tekst</label> 
                <vue-editor name="tekst" v-model="content" />
            </div>
                                        

            <div class="form-group mb-3">
                <label for="inputState">Tip posta</label>
                <select id="inputState"  name="tip" class="form-control" v-model="tip" >
                    <option selected>Post</option>
                    <option>Vest</option>
                </select>
            </div>


            <div class="mb-3">
                <label for="formFile" class="form-label">Promeni sliku</label>
                <input v-on:change="dodajSliku" class="form-control" name="slika" type="file" id="formFile" >
            </div>

            <div class="mb-3">
                <label><b>Trenutna slika:</b></label><br>
                <img type="file" v-for="d in data" style="width: 350px; height: auto;" :src=d.urlSlika />
            </div>



            <div class="col mb-3 mt-3">
                <label for="inputState">Autor posta: </label>
                <label v-for="d in data">{{ d.kolona }}</label>
            </div>
            
            <div class="mb-3 d-grid gap-2 col-4 mx-auto">
                <button type="button" @click="izmeniPost" class="btn btn-success">Sacuvaj izmene</button>
                <a type="button" href="/adminPanel/blog/prikazBlog" class="btn btn-secondary">Nazad</a>
            </div>
        </form>
      
    </div>
</template>
<script>
var csrfToken = $('meta[name="csrf-token"]').attr('content');
//   import "jquery/dist/jquery.min.js";
//   import "bootstrap/dist/css/bootstrap.min.css";
import DatePicker from 'vue2-datepicker';
import { VueEditor } from "vue2-editor";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import moment from 'moment';
  import Swal from 'sweetalert2';
  import axios from "axios";
  import $ from "jquery";

    export default {
        components: { VueEditor },
        props: {
            data:  Array,
        },
        data(){
            return {
                naslov: this.data[0].naslov,
                opis: this.data[0].opis,
                content: this.data[0].tekst,
                tip: this.data[0].tipPosta,
                slika: '',
                autor: '',
                id: this.data.length > 0 ? this.data[0].id : null,
            }
        },
        methods: {
            reloadPage() {
               window.location.reload();
            },
            formatDate(date) {
                return moment(date).format('DD.MM.YYYY HH:mm');
            },
            dodajSliku(event) {
                this.slika = event.target.files[0];
            },
            izmeniPost() {
                if(this.naslov === '' || this.opis === '' || this.content === '' || this.tip === '' || this.slika === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Molimo Vas da popunite sva polja.',
                    })
                    return;
                }
                const postData = new FormData();
                postData.append('naslov', this.naslov);
                postData.append('opis', this.opis);
                postData.append('content', this.content);
                postData.append('tip', this.tip);
                postData.append('slika', this.slika);

                axios.post('/adminPanel/blog/sacuvajIzmenuBloga', postData, {
                    params: {
                        // id: this.data[0]
                        id: this.id
                    },
                    headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'multipart/form-data',
                    },
                }).then(response => {
                    console.log(response.data);
                    Swal.fire({
                                icon: 'success',
                                title: 'Uspesno ste izmenili post!',
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.reloadPage();
                                }
                            })
                }).catch(error => {
                    // Handle any errors
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Uneli ste nedozvoljen tip fajla!',
                    });
                });
            },

        },
        mounted() {
    
    }
}

</script>

