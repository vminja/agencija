<template>
    <div>
 
        <form class="border p-4 rounded m-4" method="POST" enctype="multipart/form-data">
    
            <!-- <select disabled id="inputState" name="id" class="form-control" v-model="id">
                <option v-for="item in data" :value="item.id">{{ item.id }}</option>
            </select> -->

            <div class="col mb-3 mt-3">
                <label for="inputState">ID korisnika: </label>
                <label v-for="d in data">{{ d.id }}</label>
            </div>
           
            <div class="col mb-3 mt-3">
                <label for="inputState">Ime</label>
                <input required type="text" class="form-control" name="naslov" placeholder="Unesite naslov posta" v-model="naslov" >
            </div>
                                        

            <div class="form-group mb-3">
                <label for="inputState">Tip posta</label>
                <select id="inputState"  name="tip" class="form-control" v-model="tip" >
                    <option selected>User</option>
                    <option>Admin</option>
                </select>
            </div>
            
            <div class="mb-3 d-grid gap-2 col-4 mx-auto">
                <button type="button" @click="izmeniKorisnika" class="btn btn-success">Sacuvaj izmene</button>
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
                naslov: this.data[0].name,
                tip: this.data[0].user_type,
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
            izmeniKorisnika() {
                if(this.naslov === '' || this.tip === ''){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Molimo Vas da popunite sva polja.',
                    })
                    return;
                }
                const postData = new FormData();
                postData.append('naslov', this.naslov);
                postData.append('tip', this.tip);

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

