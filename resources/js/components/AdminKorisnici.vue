<template>
    <div>
      
      <table class="table display" id="datatable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ime</th> 
            <th>Email</th>
            <th>Password</th>
            <th>Tip</th>
            <th>Datum kreiranja</th>
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
                        url: '/adminPanel/korisnici', 
                    },
                    "columnDefs": [
                        { "targets": 0, "orderable": true},
                        { "targets": 1, "orderable": true},
                        { "targets": 2, "orderable": true},
                        {"targets": 3, "orderable": false},
                        { "targets": 4, "orderable": true},
                        { "targets": 5, "orderable": false},
                    ],
                    "columns": [
                        {"data" : "id" },
                        {"data" : "name" },
                        {"data" : "email"},
                        {"data" : "password"},
                        {"data" : "user_type"},
                        {
                            "data" : "created_at",
                            render: function (data){
                                return moment(data).format("DD.MM.Y. HH:mm");
                            }
                        },
                    ]
                    
                });
            },
        },
        mounted() {
            let th = this;

            // $(document).on('click', '.arhiviraj', function (e) {
            //    var entryId = $(this).data('entry-id');

            //     $.ajax({
            //         url: '/adminPanel/blog/arhiviraj',
            //         type: 'POST',
            //         dataType: 'json',
            //         headers: {
            //           'X-CSRF-TOKEN': csrfToken
            //         },
            //        _token: csrfToken,
            //         data: {
            //             id: entryId,
            //         },
            //         success: function(response) {
            //             if (response.success) {
            //                 console.log('bravo');
            //                 th.createDataTable();
            //                 Swal.fire({
            //                     icon: 'success',
            //                     title: 'Uspesno ste arhivirali post!',                        
            //                 })
            //             }
            //             else {
            //                 console.log('else', response);
            //             }
            //         },
            //         error: function(xhr) {
            //             console.log(xhr.responseText);
            //         },
            //     });
        
            // });

            // $(document).on('click', '.objavi', function (e) {
            //    var entryId = $(this).data('entry-id');

            //     $.ajax({
            //         url: '/adminPanel/blog/objavi',
            //         type: 'POST',
            //         dataType: 'json',
            //         headers: {
            //           'X-CSRF-TOKEN': csrfToken
            //         },
            //        _token: csrfToken,
            //         data: {
            //             id: entryId,
            //         },
            //         success: function(response) {
            //             if (response.success) {
            //                 console.log('bravo');
            //                 th.createDataTable();
            //                 Swal.fire({
            //                     icon: 'success',
            //                     title: 'Uspesno ste objavili post!',
            //                 });
                           
                        
            //             }
            //             else {
            //                 console.log('else', response);
            //             }
            //         },
            //         error: function(xhr) {
            //             console.log(xhr.responseText);
            //         },
            //     });

            // });

            // $(document).on('click', '.obrisi', function (e) {

            //     Swal.fire({
            //         title: 'Da li ste sigurni?',
            //         showCancelButton: true,
            //         confirmButtonText: 'Obrisi',
            //         cancelButtonText: 'Odustani',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             var entryId = $(this).data('entry-id');

            //         $.ajax({
            //             url: '/adminPanel/blog/obrisi',
            //             type: 'POST',
            //             dataType: 'json',
            //             headers: {
            //             'X-CSRF-TOKEN': csrfToken
            //             },
            //         _token: csrfToken,
            //             data: {
            //                 id: entryId,
            //             },
            //             success: function(response) {
            //                 if (response.success) {
            //                     console.log('bravo');
            //                     th.createDataTable();
            //                     Swal.fire({
            //                         icon: 'success',
            //                         title: 'Uspesno ste obrisali post!',
            //                     });

            //                 }
            //                 else {
            //                     console.log('else', response);
            //                 }
            //             },
            //             error: function(xhr) {
            //                 console.log(xhr.responseText);
            //             },
            //         });
            //         }
            //     })
            // });
         
            this.createDataTable();
           
        
        },
    }

</script>
