<template>
    <div>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <nuxt-link to="" class="navbar-brand">
                    <i class="fas fa-film mr-2"></i>
                    Daniel Ozeh Unsplash
                </nuxt-link>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-1 active" aria-current="page" href="">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-3" href="login">Login</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg">
            <form class="d-flex tm-search-form">
                <input class="form-control tm-search-input" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success tm-search-btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

</template>