<template>
    <nav class="navbar navbar-expand-sm bg-success mb-3">
        <div class="container-fluid">
            <h3 class="navbar-brand">Navigacioni meni</h3>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a type="button" class="nav-link btn bg-success bg-gradient-500" href="/osiguranje">Putno osiguranje</a>
                <div class="btn-group">
                    <a type="button" href="/blog" class="nav-link btn bg-success bg-gradient-500">Blog</a>
                    <a type="button" class="nav-link btn bg-success bg-gradient-500 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                    </a>
                    <ul class="dropdown-menu bg-success">
                        <li><a class="text-dark px-3" href="/adminPanel/blog/kreirajBlog">Kreiraj post</a></li>
                    </ul>
                </div>
                <div class="btn-group dropend">
                    <a type="button" class="nav-link btn bg-success bg-gradient-500  dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin panel
                    </a>
                    <ul class="dropdown-menu bg-success">
                        <label class="dropdown-header text-dark p-2"><b>POLISA</b></label>
                        <li><a href="/adminPanel/polise/prikaz" class="text-dark px-3">Pregled polisa</a></li>
                        <hr>
                        <label class="dropdown-header text-dark p-2"><b>BLOG</b></label>
                        <li><a href="/adminPanel/blog/prikazBlog" class="text-dark px-3">Pregled blogova</a></li>
                        <!-- <li><a href="/adminPanel/blog/kreirajBlog" class="text-dark px-3">Kreiraj post</a></li> -->
                        <hr>
                        <label class="dropdown-header text-dark p-2"><b>KORISNICI</b></label>
                        <li><a href="#" class="text-dark px-3">Pregled korisnika</a></li>
                    </ul>
                </div>               
            </div>
            </div> 
        </div>        
    </nav>     
</template>

<script>

export default {
 

}
  
</script>

<style>
    a:link {
        text-decoration: none;
    }
</style>