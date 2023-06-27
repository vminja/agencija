<template>
    <div>
        <!-- Button trigger modal -->
<!-- <a data-bs-toggle="modal" data-bs-target="#exampleModal">
    Grupna
</a> -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Osiguranici</h5>
        </div>
        <div class="modal-body">
            <ul>
                <!-- <li v-for="osiguranik in osiguranici">
                    {{ osiguranik.kolona }} lalala
                </li> -->
                <li>{{ osiguranici.kolona }}</li>
            </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-bs-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>


      <table class="table display" id="datatable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Datum rodjenja</th>
            <th>Telefon</th>
            <th>Datum putovanja</th>
            <th>Datum Povratka</th>
            <th>Vrsta Polise</th>
            <!-- <th>osiguranik</th> -->
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
      
    </div>
</template>


<script>
//   import "jquery/dist/jquery.min.js";
//   import "bootstrap/dist/css/bootstrap.min.css";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import moment from 'moment';
  import axios from "axios";
  import $ from "jquery";

     

    export default {
        props: {
            data: Array,
        },
        data() {
            return {
                showModal: false,
                selectedOsiguranik: null,
                osiguranici: []
            }
        },
        methods: {
            formatDate(date) {
                return moment(date).format('DD.MM.YYYY HH:mm');
            },
            createDataTable(){
                $('#datatable').DataTable().clear().destroy();
                var table = $('#datatable').DataTable({ 
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    ajax: {
                        url: '/adminPanel/polise',
                    },
                    "columnDefs": [
                        { "targets": 0, "orderable": true},
                        { "targets": 1, "orderable": true},
                        { "targets": 2, "orderable": true},
                        {"targets": 3, "orderable": false},
                        { "targets": 4, "orderable": false},
                        { "targets": 5, "orderable": true},
                        { "targets": 6, "orderable": true},
                        { "targets": 7, "orderable": false},
                        // { "targets": 8, "orderable": false},
                    ],
                    "columns": [
                        {"data" : "id" },
                        {"data" : "ime" },
                        {"data" : "prezime"},
                        {
                            "data" : "datum_rodjenja",
                            render: function (data){
                                    return moment(data).format("DD.MM.Y. HH:mm");
                                }
                        },
                        {"data" : "telefon" },
                        {
                            "data" : "datumPutovanja",
                            render: function (data){
                                    return moment(data).format("DD.MM.Y. HH:mm");
                                }
                        },
                        {
                            "data" : "datumPovratka",
                            render: function (data){
                                return moment(data).format("DD.MM.Y. HH:mm");
                            }
                        },
                        { 
                            "data": "vrstaPolise",
                            render: function (data, type, row) {
                                if (data == 'grupno') {
                                return '<a class="prikaz" data-bs-toggle="modal" data-bs-target="#exampleModal" data-entry-id="' + row.id + '">Grupna</a>'
                                } else {
                                return 'Individualna';
                                }
                            }
                        }, 
                        // { "data" : "kolona" }, 
                        
                    ]
                    
                });

            },
          
        },
        mounted() {

            this.createDataTable();
            
            $(document).on('click', '.prikaz', function (e) {
               var entryId = $(this).data('entry-id');
                $.ajax({
                    url: '/adminPanel/polise/osiguranici',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id: entryId,
                    },
                    success: function(response) {
                        if (response.success) {
                            this.osiguranici = response;
                            console.log('bravo');
                            
                        }
                        else {
                            this.osiguranici = response;
                            console.log('else', response);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                });
            
            });



        
        },

    }

</script> 

<!-- <script>
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import moment from 'moment';
import axios from "axios";
import $ from "jquery";
import Vue from 'vue';
import Popover from 'vue-js-popover';
 
Vue.use(Popover);

export default {
    props: {
        data: Array,
    },
    data() {
        return {
            // data: [],
        }
    },
    methods: {
        formatDate(date) {
            return moment(date).format('DD.MM.YYYY HH:mm');
        },
        createDataTable() {
            $('#datatable').DataTable().clear().destroy();
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: '/adminPanel/blog',
                },
                columnDefs: [
                    { targets: 0, orderable: true },
                    { targets: 1, orderable: true },
                    { targets: 2, orderable: true },
                    { targets: 3, orderable: false },
                    { targets: 4, orderable: false },
                    { targets: 5, orderable: true },
                    { targets: 6, orderable: true },
                    { targets: 7, orderable: false },
                    { targets: 8, orderable: false },
                ],
                columns: [
                    { data: "id" },
                    { data: "ime" },
                    { data: "prezime" },
                    {
                        data: "datum_rodjenja",
                        render: function (data) {
                            return moment(data).format("DD.MM.Y. HH:mm");
                        }
                    },
                    { data: "telefon" },
                    {
                        data: "datumPutovanja",
                        render: function (data) {
                            return moment(data).format("DD.MM.Y. HH:mm");
                        }
                    },
                    {
                        data: "datumPovratka",
                        render: function (data) {
                            return moment(data).format("DD.MM.Y. HH:mm");
                        }
                    },
                    {  
                        'data': "vrstaPolise",
                        render: function (data, type, row) {
                            if (data == 'grupno') {
                                return '<a> Grupna </a>';
                                
                            } else {
                                return 'Individualna';
                            }
                        }
                    },
                    { data: "kolona" },
                ]
            });
        },
    },
    mounted() {
        this.createDataTable();
    }
}
</script> -->
