<template>
    <div>
      <zaglavlje></zaglavlje>
 
      <table class="table display" id="datatable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Autor</th>
            <th>Naslov</th>
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
var csrfToken = $('meta[name="csrf-token"]').attr('content');
//   import "jquery/dist/jquery.min.js";
//   import "bootstrap/dist/css/bootstrap.min.css";
  import "datatables.net-dt/js/dataTables.dataTables";
  import "datatables.net-dt/css/jquery.dataTables.min.css";
  import moment from 'moment';
  import Swal from 'sweetalert2';
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
                        url: '/adminPanel/blog/prikaz',
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
                    ],
                    "columns": [
                        {"data" : "id" },
                        {"data" : "kolona" },
                        {"data" : "naslov"},
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
                                                '<a  type="button" class="dropdown-item" href="#">Pregled</a>' +
                                                '<a  type="button" class="dropdown-item" href="/adminPanel/blog/izmeniBlog/' + row.id + '">Izmeni</a>' +
                                                '<a  type="button" class="dropdown-item obrisi" href="#"  data-entry-id="' + row.id + '">Obrisi</a>' +
                                                '<a  type="button" class="dropdown-item objavi" href="#" data-entry-id="' + row.id + '">Objavi</a>'+
                                                '<a  type="button" class="dropdown-item arhiviraj" href="#" data-entry-id="' + row.id + '">Arhiviraj</a>'+
                                            '</div>' +
                                        '</div>';
                                        
                            },
                        }
                    ]
                    
                });
            },
        },
        mounted() {
            
            $(document).on('click', '.arhiviraj', function (e) {
               var entryId = $(this).data('entry-id');

                $.ajax({
                    url: '/adminPanel/blog/arhiviraj',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                      'X-CSRF-TOKEN': csrfToken
                    },
                   _token: csrfToken,
                    data: {
                        id: entryId,
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('bravo');
                            Swal.fire({
                                icon: 'success',
                                title: 'Uspesno ste arhivirali post!',
                            });
                           
                        
                        }
                        else {
                            console.log('else', response);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                });
            });

            $(document).on('click', '.objavi', function (e) {
               var entryId = $(this).data('entry-id');

                $.ajax({
                    url: '/adminPanel/blog/objavi',
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                      'X-CSRF-TOKEN': csrfToken
                    },
                   _token: csrfToken,
                    data: {
                        id: entryId,
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('bravo');
                            Swal.fire({
                                icon: 'success',
                                title: 'Uspesno ste objavili post!',
                            });
                           
                        
                        }
                        else {
                            console.log('else', response);
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                });
            });

            $(document).on('click', '.obrisi', function (e) {
                if (confirm("Da li ste sigurni?")) {
                    e.preventDefault();
                    var entryId = $(this).data('entry-id');

                    $.ajax({
                        url: '/adminPanel/blog/obrisi',
                        type: 'POST',
                        dataType: 'json',
                        headers: {
                        'X-CSRF-TOKEN': csrfToken
                        },
                    _token: csrfToken,
                        data: {
                            id: entryId,
                        },
                        success: function(response) {
                            if (response.success) {
                                console.log('bravo');
                                // this.createDataTable();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Uspesno ste obrisali post!',
                                });
                            
                            
                            }
                            else {
                                console.log('else', response);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        },
                    });
                }
            });
         
            this.createDataTable();
           
        
        },
    }

    


  

</script>
