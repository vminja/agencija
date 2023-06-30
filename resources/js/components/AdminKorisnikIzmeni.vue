<template>
    <div>
 
        <form class="border p-4 rounded m-4" method="POST">

            <div class="col mb-3 mt-3">
                <label for="inputState" v-for="d in data">ID posta: {{ d.id }} </label>
            </div>
           
            <div class="col mb-3 mt-3">
                <label for="inputState">Ime</label>
                <input required type="text" class="form-control" name="ime" placeholder="Unesite ime korisnika" v-model="ime" >
            </div>
                                        
            <div class="form-group mb-3">
                <label for="inputState">Tip korisnika</label>
                <select id="inputState"  name="tip" class="form-control" v-model="tip" >
                    <option selected>user</option>
                    <option>admin</option>
                </select>
            </div>
            
            <div class="mb-3 d-grid gap-2 col-4 mx-auto">
                <button type="button" @click="izmeniKorisnika" class="btn btn-success">Sacuvaj izmene</button>
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
        components: { VueEditor },
        props: {
            data: Array,
        },
        data(){
            return {         
                ime: this.data[0].name,
                tip: this.data[0].user_type,
                id: this.data.length > 0 ? this.data[0].id : null,
            }
        },
        methods: {
            reloadPage() {
               window.location.reload();
            },
            izmeniKorisnika() {
                if(this.ime === '' || this.tip === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Molimo Vas da popunite sva polja.',
                    })
                    return;
                }
                const korisnikData = new FormData();
                korisnikData.append('ime', this.ime);
                korisnikData.append('tip', this.tip);

                axios.post('/adminPanel/blog/sacuvajIzmenuKorisnika', korisnikData, {
                    params: {
                        // id: this.data[0]
                        id: this.id
                    },
                    headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    },
                }).then(response => {
                    console.log(response.data);
                    Swal.fire({
                                icon: 'success',
                                title: 'Uspesno ste izmenili podatke o korisniku!',
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    this.reloadPage();
                                }
                            })
                }).catch(error => {
                    // Handle any errors
                    console.error(error);
                });
            },

        },
        mounted() {
    
    }
}

</script>

