<template>
    <div>
 
            <!-- za grupne polise modal ili nova stranica -->
            <!-- ili dodavanje na tabelu -->
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
            <th>osiguranik</th>
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
                    ajax: {
                        url: '/adminPanel/blog',
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
                        { "targets": 8, "orderable": false},
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
                        { "data" : "vrstaPolise" }, 
                        { "data" : "kolona" }, 
                    ]
                    
                });

                // $('#datatable').on('click', 'td.dt-control', function () {
                //     var tr = $(this).closest('tr');
                //     var row = table.row(tr);
            
                //     if (row.child.isShown()) {
                //         // This row is already open - close it
                //         row.child.hide();
                //         tr.removeClass('shown');
                //     } else {
                //         // Open this row
                //         row.child(format(row.data())).show();
                //         tr.addClass('shown');
                //     }
                // });
            },
            // format(d) {
            //     // `d` is the original data object for the row
            //     return (
            //         '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            //         '<tr>' +
            //         '<td>Full name:</td>' +
            //         '<td>' +
            //         'd.name' +
            //         '</td>' +
            //         '</tr>' +
            //         '<tr>' +
            //         '<td>Extension number:</td>' +
            //         '<td>' +
            //        ' d.ext' +
            //         '</td>' +
            //         '</tr>' +
            //         '<tr>' +
            //         '<td>Extra info:</td>' +
            //         '<td>And any further details here (images etc)...</td>' +
            //         '</tr>' +
            //         '</table>'
            //     );
            // },
        },
        mounted() {

            // $(document).on('click', '.dropdown-toggle', function () {
            //     $(this).siblings('.dropdown-menu').toggle();
            // });
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