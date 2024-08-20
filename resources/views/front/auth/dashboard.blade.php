@extends('front.layout.layout')
@section('content')
    <!-- Content -->
     <main class="main">
          <section class="section-box">
               <div class="container pt-50">
                    <div class="row">
                         <div class="col-lg-2"></div>
                         <div class="col-lg-8 text-center">
                              <h1 class="section-title-large mb-30 wow animate__animated animate__fadeInUp">Dashboard
                              </h1>
                              <h5 class="mb-30 text-muted wow animate__animated animate__fadeInUp">Tellus praesent
                                   vulputate placerat enim donec eget fermentum diam nunc erat commodo ornare eget lorem
                                   pharetra sit pharetra</h5>
                         </div>
                    </div>
               </div>
          </section>

          <section class="dashboard-tabs">
               <div class="container">
                    <div class="row">
                         <div class="col-lg-3">
                              <div class="side-table">
                                @include('front.auth.sidebar')
                              </div>
                         </div>
                         <div class="col-lg-9">
                              <div class="maintable">
                                   <h3>{{ Auth::user()->name }}</h3>
                                   <p>Welcome to your account dashboard. you can easily check & view your recent orders,
                                        manage your shipping and billing addresses and edit your password and account
                                        details.</p>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
     </main>
    <!-- End Content -->
@endsection
