<template>
    <div>
 
        <form class="border p-4 rounded m-4" method="POST" enctype="multipart/form-data">
                    
            <!-- <div class="col mb-3 mt-3">
                <label for="inputState">ID posta</label>
                <input disabled type="text" class="form-control" name="idPosta">
            </div> -->

            <div class="col mb-3 mt-3">
                <label for="inputState">Naslov</label>
                <input required type="text" class="form-control" name="naslov" placeholder="Unesite naslov posta" v-model="naslov">
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

                <select id="inputState"  name="tip" class="form-control" v-model="tip">
                    <option selected>Post</option>
                    <option>Vest</option>
                </select>
            </div>


            <div class="form-group mb-3">
                <label for="inputState2">Status posta</label>
                <!-- <input class="form-control" type="text" value="U pripremi" name="statusPosta" disabled readonly/> -->

                <select id="inputState2" v-model="statusPosta" name="statusPosta" class="form-control">
                    <option selected>U pripremi</option>
                    <option>Objavljeno</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Dodaj sliku</label>
                <input v-on:change="dodajSliku" class="form-control" name="slika" type="file" id="formFile" >
            </div>


            

            <div class="form-group mb-3">
                <label for="autor">Autor</label>
                <select id="autor" v-model="autor" name="autor" class="form-control">
                    <option v-for="item in data" :value="item.id">{{ item.ime }} {{ item.prezime }} - {{ item.id }}</option>
                </select>
            </div>
        
            <div class="mb-3">
                <label class="p-1" for="inputState">Datum kreiranja posta</label> <br>
                <!-- <input disabled type="date" class="form-control" v-model="datumKreiranja"> -->
                <date-picker disabled v-model="datumKreiranja" type="date" :format="dateFormat"></date-picker>

            </div>
            

            <div class="mb-3 d-grid gap-2 col-4 mx-auto">
                <button id="dugme" type="button" class="btn btn-success" @click="dodajPost">Kreiraj post</button>
                <a type="button" href="/blog" class="btn btn-secondary">Nazad</a>
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
        components: { VueEditor, DatePicker },
        props: {
            data: Array,
        },
        data(){
            return{
                item:'',
                autor:'',
                dateFormat : 'DD.MM.YYYY',
                naslov:'',
                opis:'',
                tip:'Post',
                statusPosta: 'U pripremi',
                datumKreiranja: new Date(),
                content:'',
                slika: null,
                // data: [],
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
                // return this.slika;
            },
            // dodajPost() {

            //     const postData = {
            //         naslov: this.naslov,
            //         opis: this.opis,
            //         content: this.content,
            //         tip: this.tip,
            //         statusPosta: this.statusPosta,
            //         // slika: URL.createObjectURL(this.slika) ,
            //         slika: this.slika,
            //         datumKreiranja: this.datumKreiranja,
            //     };

            //     axios.post('/adminPanel/blog/napraviBlog', postData, {
            //             headers: {
            //             'X-CSRF-TOKEN': csrfToken,
            //             // 'Content-Type': 'multipart/form-data',
            //         }
            //     }).then(response => {
            //             console.log(response.data);

            //         }).catch(error => {
            //             // Handle any errors
            //             console.error(error);
            //         });
            // },
            
            dodajPost() {
                if(this.naslov === '' || this.opis === '' || this.datumKreiranja === '' || this.content === '' || this.tip === '' || this.slika === '' || this.autor === '' || this.statusPosta === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Molimo Vas da popunite sva polja.',
                    })
                    return; 
                }
                const postData = new FormData();
                postData.append('autor', this.autor);
                postData.append('naslov', this.naslov);
                postData.append('opis', this.opis);
                postData.append('content', this.content);
                postData.append('tip', this.tip);
                postData.append('statusPosta', this.statusPosta);
                postData.append('slika', this.slika);
                postData.append('datumKreiranja', this.datumKreiranja);

                axios.post('/adminPanel/blog/napraviBlog', postData, {
                    headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'multipart/form-data',
                    },
                }).then(response => {
                    console.log(response.data);
                    Swal.fire({
                                icon: 'success',
                                title: 'Uspesno ste napravili post!',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.reloadPage();
                                } 
                            })    
                }).catch(error => {
                    // Handle any errors
                    console.error('greska!',error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Uneli ste nedozvoljen tip fajla!',
                    });
                });
            },

        },
        mounted() {

        },

    }


</script>

