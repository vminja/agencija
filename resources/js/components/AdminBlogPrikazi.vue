<template>
    <div>

        <zaglavlje></zaglavlje>

            <div class="border m-3 p-3">

                <!-- <div class="col mb-3 mt-3">
                    <label v-for="d in data"><b>ID posta: </b> {{ d.id }}</label>
                </div> -->
            
                <div class="col mb-3 mt-3 d-flex justify-content-center">
                    <h1 v-for="d in data">{{ d.naslov }}</h1>
                </div>

                <div class="d-flex justify-content-center">
                    <img type="file" class="rounded" v-for="d in data" style="width: 650px; height: auto;" :src=d.urlSlika />
                </div>

                <hr>
                <div class="col mb-3 mt-3 d-flex justify-content-center">
                    <p class="p-2" v-bind="htmlString"  v-html="decodedHtml"></p>
                </div>
                                            
                <hr>
                <div class="col mb-3 mt-3">
                    <label v-for="d in data"><b>Autor posta: </b>{{ d.kolona }}</label>
                </div>

                <div class="col mb-3 mt-3">
                    <label v-for="d in data"><b>Datum kreiranja posta: </b>{{ formatDate(d.created_at) }}</label>
                </div>
                
                <div class="mb-3 d-grid gap-2 col-4 mx-auto">
                    <a type="button" class="btn btn-success text-white" href="/blog">Nazad</a>
                </div>


            </div>
            
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
        props: {
            data:  Array,
        },
        data(){
            return {
                htmlString: this.data[0].tekst,
                // content: this.data[0].tekst,
                id: this.data.length > 0 ? this.data[0].id : null,
            }
        },
        methods: {
            formatDate(date) {
                return moment(date).format('DD.MM.YYYY HH:mm');
            },
        },
        mounted() {
    
        },
        computed: {
            decodedHtml() {
                const parser = new DOMParser();
                const decoded = parser.parseFromString(this.htmlString, "text/html").body.innerHTML;
                return decoded;
            }
         }
    }

</script>

