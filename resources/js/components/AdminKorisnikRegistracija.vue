<template>
    <div>
 
        <form class="border p-4 rounded m-4" method="POST">
                    
            <div class="col mb-3 mt-3">
                <label for="inputState">Ime korisnika:</label>
                <input required type="text" class="form-control" name="ime" placeholder="Unesite ime korisnika" v-model="ime">
            </div>
        
            <div class="col mb-3 mt-3">
                <label for="inputState">Email korisnika:</label> 
                <input required type="email" class="form-control" name="email" placeholder="Unesite email korisnika" v-model="email">
            </div>
            
            <div class="col mb-3 mt-3">
                <label for="inputState">Unesite sifru korisnika:</label> 
                <input required type="password" class="form-control" name="password" placeholder="Unesite sifru korisnika" v-model="password">
            </div>
                                        

            <div class="form-group mb-3">
                <label for="inputState">Tip korisnika</label>
                <select id="inputState"  name="tip" class="form-control" v-model="tip" >
                    <option selected>user</option>
                    <option>admin</option>
                </select>
            </div>
        
            <div class="mb-3">
                <label class="p-1" for="inputState">Datum kreiranja posta</label> <br>
                <!-- <input disabled type="date" class="form-control" v-model="datumKreiranja"> -->
                <date-picker disabled v-model="datumKreiranja" type="date" :format="dateFormat"></date-picker>
            </div>
            

            <div class="mb-3 d-grid gap-2 col-4 mx-auto">
                <button id="dugme" type="button" class="btn btn-success" @click="registruj">Kreiraj post</button>
                <a type="button" href="/adminPanel/korisnici" class="btn btn-secondary">Nazad</a>
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
                dateFormat : 'DD.MM.YYYY',
                ime:'',
                email:'',
                tip:'user',
                password: '',
                datumKreiranja: new Date(),
                // data: [],
            }
        },
        methods: {
            formatDate(date) {
                return moment(date).format('DD.MM.YYYY HH:mm');
            },
            registruj() {
                if(this.ime === '' || this.email === '' || this.password === '' || this.datumKreiranja === '' || this.tip === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Molimo Vas da popunite sva polja.',
                    })
                    return;
                }
                const postData = new FormData();
                postData.append('ime', this.ime);
                postData.append('email', this.email);
                postData.append('password', this.password);
                postData.append('tip', this.tip);
                postData.append('datumKreiranja', this.datumKreiranja);

                axios.post('/adminPanel/korisnici/registracijaSacuvaj', postData, {
                    headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    },
                }).then(response => {
                    console.log(response.data);
                    Swal.fire({
                                icon: 'success',
                                title: 'Uspesno ste napravili korisnika!',
                            });

                            this.ime ='',
                            this.email = '',
                            this.tip = 'user',
                            this.password = ''
                            
                }).catch(error => {
                    // Handle any errors
                    console.error('greska!',error);
                });
            },
           
        },
        mounted() {

        },

    }


</script>

