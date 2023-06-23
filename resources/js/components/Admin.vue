<template>
    <div>
      <zaglavlje></zaglavlje>
 
      <table class="table display" id="datatable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Autor</th>
            <th>Naslov</th>
            <th>Opis</th>
            <th>Tekst</th>
            <th>Tip</th>
            <th>Status</th>
            <th>Datum kreiranja</th>
            <th>Datum arhiviranja</th>
            <th>Datum objavljivanja</th>
            <th>Cover</th>
            <th>Akcija</th>
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
        data(){
            return{
                // data: [],
            }
        },
        methods: {
            formatDate(date) {
                return moment(date).format('DD.MM.YYYY HH:mm');
            },
            createDataTable(){
                $('#datatable').DataTable().clear().destroy();
                $('#datatable').DataTable({ 
                    processing: true,
                    serverSide: true,
                    "destroy": true,
                    // data: this.data,
                    ajax: {
                        url: '/adminPanel/server',
                    },
                    "columnDefs": [
                        { "targets": 0, "orderable": true},
                        { "targets": 1, "orderable": true},
                        { "targets": 2, "orderable": true},
                        {"targets": 3, "orderable": true},
                        { "targets": 4, "orderable": false},
                        { "targets": 5, "orderable": true},
                        { "targets": 6, "orderable": true},
                        { "targets": 7, "orderable": false},
                        { "targets": 8, "orderable": false},
                        { "targets": 9, "orderable": false},
                        { "targets": 10, "orderable": false},
                        { "targets": 11, "orderable": false},
                    ],
                    "columns": [
                        {"data" : "id" },
                        {"data" : "kolona" },
                        {"data" : "naslov"},
                        {"data" : "opis"},
                        {
                            "data" : "tekst"
                        },
                        {"data" : "tipPosta"},
                        {"data" : "Status"},
                        {
                            "data" : "created_at",
                            render: function (data){
                                return moment(data).format("DD.MM.Y. HH:mm");
                            }
                        },
                        {
                            "data" : "archived_at",
                            render: function (data){
                                return moment(data).format("DD.MM.Y. HH:mm");
                            }
                        },
                        {
                            "data" : "published_at",
                            render: function (data){
                                return moment(data).format("DD.MM.Y. HH:mm");
                            }
                        },
                        {
                            "data" : "urlSlika",
                            render: function (data, type, row) {
                                return '<img src="' + data + '" '+ 'style="width:120px; height:100px"' +'>';
                            }
                        }, 
                        {
                            "data" : "akcije",
                            render: function (data, type, row) {
                                return  '<div class="dropdown">' +
                                            '<button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown">Akcija</button>' +
                                            '<div class="dropdown-menu">'+
                                                '<a  type="button" class="dropdown-item" href="#">Action</a>' +
                                                '<a  type="button" class="dropdown-item" href="#">Action 2</a>' +
                                                '<a  type="button" class="dropdown-item" href="#">Action 3</a>' +
                                            '</div>' +
                                        '</div>';
                                
                            },
                        }
                    ]
                    
                });
            },
            otvori(){
                return true
            },
        },
        mounted() {

            $(document).on('click', '.dropdown-toggle', function () {
                $(this).siblings('.dropdown-menu').toggle();
            });
            this.createDataTable();
            // $('.dropdown-toggle').dropdown();
        
        },

    }

    


  

</script>

<style>
.text-wrap {
  white-space: normal !important;
  word-wrap: break-word;
}
</style>