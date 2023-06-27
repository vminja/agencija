<template>
    <div>
        <zaglavlje></zaglavlje>
          <div class="position-absolute bg-success" style="width: 200px; left:0%;">
            <nav class="navbar navbar-dark bg-success">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span>Polisa</span>
                  </button>
                </div>
            </nav>
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-success p-4">
                  <a href="/adminPanel/polise/prikaz" class="text-dark">Pregled polisa</a> 
                </div>
            </div>
    
            
            <nav class="navbar navbar-dark bg-success border-top border-dark" >
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent2" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span>Blog</span>
                  </button>
                </div>
            </nav>
            <div class="collapse" id="navbarToggleExternalContent2">
                <div class="bg-success p-4">
                  <a href="/adminPanel/blog/prikazBlog" class="text-dark">Pregled blogova</a> 
                  <hr>
                  <a href="adminPanel/blog/kreirajBlog" class="text-dark">Kreiraj post</a>
                </div>
            </div>
            
            <nav class="navbar navbar-dark bg-success border-top border-dark">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent3" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span>Korisnici</span>
                  </button>
                </div>
            </nav>
            <div class="collapse border-bottom border-dark" id="navbarToggleExternalContent3">
                <div class="bg-success p-4">
                  <a href="#" class="text-dark">Pregled korisnika</a> 
                </div>
            </div>

          </div>
       

    </div>

    

</template>
<script>
    import moment from 'moment';
    import axios from "axios";
    import $ from "jquery";

    export default {
        data(){
            return{
                
            }
        },
        methods: {

        },
        mounted() {
            $(document).on('click', '.dropdown-toggle', function () {
                $(this).siblings('.dropdown-menu').toggle();
            });
          
        },

    }

    