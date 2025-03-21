@extends('layout.fe')
@section('content')
<!-- Masthead-->
<header class="masthead">
    <div class="container">
        <div class="masthead-subheading" id="masthead-title">Welcome To Our Studio!</div>
        <div class="masthead-heading text-uppercase " id="masthead-subtitle"></div>
        <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
    </div>
</header>
<!-- Services-->
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Produk</h2>
            <h3 class="section-subheading text-muted"> </h3>
        </div>
        <div id="services_content" class="row text-center">
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">E-Commerce</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Responsive Design</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
            <div class="col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fas fa-circle fa-stack-2x text-primary"></i>
                    <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
                </span>
                <h4 class="my-3">Web Security</h4>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
            </div>
        </div>
    </div>
</section>
<!-- Portfolio Grid-->
<section class="page-section bg-light" id="portfolio">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Portfolio</h2>
            <h3 class="section-subheading text-muted"></h3>
        </div>
        <div class="row" id="portofolio_content">

        </div>
    </div>
</section>
<!-- About-->
<section class="page-section" id="about">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">About</h2>
            <h3 class="section-subheading text-muted"></h3>
        </div>
        <ul id="about_content" class="timeline">

        </ul>
    </div>
</section>
<!-- Contact-->
<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted"></h3>
        </div>
        <form id="contactForm" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <!-- Name input-->
                        <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required />
                    </div>
                    <div class="form-group">
                        <!-- Email address input-->
                        <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required />

                    </div>
                    <div class="form-group mb-md-0">
                        <!-- Phone number input-->
                        <div class="row mt-1">
                            <div class="col-sm-2">
                                <input type="text" class="form-control" value="+62" readonly disabled>
                            </div>
                            <div class="col-sm-10">
                                <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone *" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">
                        <!-- Message input-->
                        <textarea class="form-control" id="message" name="message" placeholder="Your Message *" required></textarea>

                    </div>
                </div>
            </div>

            <!-- Submit Button-->
            <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase " id="submitButton" type="button">Send Message</button></div>
        </form>
    </div>
</section>
<!-- Portfolio item 1 modal popup-->
<div class="portfolio-modal modal fade" id="portfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img src="{{asset('template_fe/assets/img/close-icon.svg')}}" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 id="portofolio_title" class="text-uppercase">Project Name</h2>
                            <p class="item-intro text-muted"></p>
                            <img id="portofolio_img" class="img-fluid d-block mx-auto" src="{{asset('template_fe/assets/img/portfolio/1.jpg')}}" alt="..." />
                            <p id="portofolio_description">Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <ul class="list-inline">
                                <li>
                                    <strong>Client:</strong>
                                    <span id="portofolio_client"></span>

                                </li>
                                <li>
                                    <strong>Category:</strong>
                                    <span id="portofolio_category"></span>

                                </li>
                            </ul>
                            <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                <i class="fas fa-xmark me-1"></i>
                                Close Project
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('document').ready(function(e) {
        $.ajax({
            url: "{{ route('public.data') }}", // URL yang sudah benar
            method: 'GET',
            beforeSend: function() {
                $('.loader-overlay').css('display', 'flex');
            },
            success: function(response) {
                // pastikan data master_head ada
                let masterhead = response.master_head;
                let services = response.services;
                let portofolio = response.portofolio;
                let about = response.about;
                if (masterhead) {
                    $('#masthead-title').empty().text(masterhead.title);
                    $('#masthead-subtitle').empty().text(masterhead.subtitle);
                    $('.masthead').css({
                        'background-image': `url("{{ asset('storage') }}/${masterhead.image}")`
                    });
                }
                if (services && services.length > 0) {
                    $('#services_content').empty();
                    services.forEach(function(services) {
                        let serviceItem = `
                        <div class="col-md-4 image-hover" data-aos="zoom-in" data-aos-duration="2000"  data-aos-offset="400">
                            <img src="{{ asset('storage') }}/${services.image}" alt="" class="rounded " height="130px">
                            <h4 class="my-3">${services.title}</h4>
                            <p class="text-muted">${services.description}</p>
                        </div>
                        `;
                        $('#services_content').append(serviceItem);
                    });
                }
                if (portofolio && portofolio.length > 0) {
                    $('#portofolio_content').empty();
                    portofolio.forEach(function(porto) {
                        let portoItem = `
                        <div class="col-lg-4 col-sm-6 mb-4">
                            <div class="portfolio-item" data-aos="flip-left" data-aos-duration="2000" data-aos-offset="400">
                                <a class="portfolio-link" data-slug="${porto.slug}" data-bs-toggle="modal" href="#">
                                    <div class="portfolio-hover">
                                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                    </div>
                                    <img class="img-fluid" src="{{asset('/storage/${porto.image}')}}" alt="..." height="450px"/>
                                </a>
                                <div class="portfolio-caption">
                                    <div class="portfolio-caption-heading">${porto.client}</div>
                                    <div class="portfolio-caption-subheading text-muted">${porto.category}</div>
                                </div>
                            </div>
                        </div>
                        `;
                        $('#portofolio_content').append(portoItem);
                    });
                }
                if (about && about.length > 0) {
                    $("#about_content").empty();
                    let aboutItem = '';
                    about.forEach(function(item, index) {
                        let invertedClass = (index % 2 != 0) ? 'timeline-inverted' : '';

                        aboutItem += `
                            <li class="${invertedClass}">
                                <div class="timeline-image" data-aos="fade-up-right" data-aos-duration="2000" data-aos-offset="400">
                                    <img class="rounded-circle img-fluid" src="{{asset('/storage/${item.image}')}}" alt="..." height="200px" width="200px" /></div>
                                <div class="timeline-panel" data-aos="fade-up-left" data-aos-duration="2000" data-aos-offset="400">
                                    <div class="timeline-heading">
                                        <h4>${item.year}</h4>
                                        <h4 class="subheading">${item.title}</h4>
                                        <p>${item.description}</p>
                                    </div>
                                </div>
                            </li>
                        `;
                    });
                    aboutItem += `
                        <li class="timeline-inverted" data-aos="zoom-out-down" data-aos-duration="2000" data-aos-offset="300">
                            <div class="timeline-image">
                                <h4>
                                    Hubungi
                                    <br />
                                    Kami
                                    <br />
                                    Dibawah ini
                                </h4>
                            </div>
                        </li>
                    `;
                    $("#about_content").append(aboutItem);
                }
            },
            complete: function() {
                $('.loader-overlay').css('display', 'none');
            },
        });
        $(document).on('click', '.portfolio-link', function(e) {
            e.preventDefault();
            let slug = $(this).data('slug');
            $.ajax({
                url: "{{route('detail')}}?slug=" + slug,
                type: "GET",
                data: {
                    "_token": "{{ csrf_token()}}",
                },
                dataType: "JSON",
                cache: "false",
                beforeSend: function() {
                    $('.loader-overlay').css('display', 'flex');
                },
                success: function(data) {
                    if (data.success === 1) {
                        let portofolio = data.data;
                        let title = portofolio.title;
                        let description = portofolio.description;
                        let client = portofolio.client;
                        let category = portofolio.category;
                        let image = portofolio.image;
                        $("#portofolio_title").empty().text(title);
                        $("#portofolio_img").attr('src', "{{asset('storage')}}/" + image).height(400);
                        $("#portofolio_description").empty().text(description);
                        $("#portofolio_client").empty().text(client);
                        $("#portofolio_category").empty().text(category);
                        $("#portfolioModal").modal('show');

                    } else {
                        toastr_error(data.message);
                    }
                },
                complete: function() {
                    $('.loader-overlay').css('display', 'none');
                },
            });
        });

        $("#submitButton").on('click', function() {
            let postData = new FormData($("#contactForm")[0]);
            $.ajax({
                url: "{{route('send.contact')}}",
                data: postData,
                type: "POST",
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.loader-overlay').css('display', 'flex');
                },
                success: function(data) {
                    if (data.success == 1) {
                        $("#contactForm")[0].reset();
                        toastr_success(data.messages);
                    } else {
                        toastr_error(data.messages);
                    }
                },
                complete: function() {
                    $('.loader-overlay').css('display', 'none');
                },
            });
        });

        function toastr_success(msg) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: msg
            });
        }

        function toastr_error(msg) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: msg
            });
        }
    });



    gsap.from('.masthead-heading', {
        duration: 1,
        y: -50,
        opacity: 0,
        delay: 1,
        ease: 'bounce'
    });
    gsap.from('.masthead-subheading', {
        duration: 1,
        x: -50,
        opacity: 0,
        delay: 1.5,
        ease: 'back'
    });
</script>


<style>
    .image-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .image-hover:hover {
        transform: scale(1.1);
        /* Memperbesar gambar */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        /* Menambahkan bayangan */
    }
</style>
@endsection