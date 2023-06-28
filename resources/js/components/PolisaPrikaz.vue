<template>
    <div>
        <zaglavlje></zaglavlje>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Osiguranici</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="osiguranik in osiguranici">
                            {{ osiguranik.ime }} {{ osiguranik.prezime }} - {{ formatDate(osiguranik.datum_rodjenja) }}
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
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
                osiguranici: [],
            }
        },
        methods: {
            formatDate(date) {
                return moment(date).format('DD.MM.YYYY');
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
                    ],
                    "columns": [
                        {"data" : "id" },
                        {"data" : "ime" },
                        {"data" : "prezime"},
                        {
                            "data" : "datum_rodjenja",
                            render: function (data){
                                    return moment(data).format("DD.MM.Y.");
                                }
                        },
                        {"data" : "telefon" },
                        {
                            "data" : "datumPutovanja",
                            render: function (data){
                                    return moment(data).format("DD.MM.Y.");
                                }
                        },
                        {
                            "data" : "datumPovratka",
                            render: function (data){
                                return moment(data).format("DD.MM.Y.");
                            }
                        },
                        { 
                            "data": "vrstaPolise",
                            render: function (data, type, row) {
                                if (data == 'grupno') {
                                return '<button type="button" class="btn btn-success prikaz" data-bs-toggle="modal" data-bs-target="#exampleModal" data-entry-id="' + row.id + '" data-bs-dismiss="modal">Grupna</button>';
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
            let th = this;
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
                            console.log('bravo', response);
                            th.osiguranici = response.podaci;
                        }
                        else {
                            console.log('else' ,  response);
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
