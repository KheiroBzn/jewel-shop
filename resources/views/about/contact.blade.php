@extends('layouts.layout')
@section('title', 'Contactez-nous')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box" style="background: url('{{ url('images/jewelry/ui-instagram/bg.jpg') }}') no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Contactez-nous</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Accueil</a></li>
                        <li class="breadcrumb-item active"> Contactez-nous </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-12 ">
                    <div class="contact-info-left h-100">
                        <h2>INFORMATIONS DE CONTACT</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent urna diam, maximus ut
                            ullamcorper quis, placerat id eros. Duis semper justo sed condimentum rutrum. Nunc tristique
                            purus turpis. Maecenas vulputate. </p>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Adresse: Tlemcen. <br>Tlemcen,<br> Tlemcen </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Tél: <a href="tel:+1-888705770">+213-43 000
                                        000</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a
                                        href="mailto:l3info2023@gmail.com">l3info2023@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 col-sm-12">
                    <div class="banner-frame"> <img class="img-thumbnail img-fluid"
                            src="{{ url('images/jewelry/' . $randomProduct->categorie . '/' . $randomProduct->nom . '/' . $randomProduct->nom . ' img1.jpg') }}"
                            alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/1.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/2.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/3.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/4.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/5.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/6.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/7.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/8.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/9.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ url('images/jewelry/ui-instagram/10.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->

@endsection