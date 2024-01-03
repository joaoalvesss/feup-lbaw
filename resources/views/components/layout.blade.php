<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script type="text/javascript">
            // Fix for Firefox autofocus CSS bug
            // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
        </script>
        <script type="text/javascript" src={{ asset('js/app.js') }} defer></script>
        <script src="//unpkg.com/alpinejs" defer></script>
    </head>
    <body class="d-flex flex-column min-vh-100" style="background-color: #01497C;">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid" style="max-height: 50px; max-width: 150px;"/>
                    GameSpace
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <form class="d-flex mx-auto" action ="/" method="GET">
                        <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        @auth
                          @can('isAdmin', App\Models\User::class)
                            <li>
                              <a class="nav-link" href="/admin">
                                <i class="fa-solid fa-cog"></i> 
                                Management Area
                              </a>
                            </li>
                          @else
                            <li>
                              <a class="nav-link" href="/credits">
                                <i class="fa fa-coins"></i>
                                Credits: {{auth()->user()->credits}}€
                              </a>
                            </li>
                            <li>
                              <a class="nav-link" href="/wishlist">
                                <i class="fa-solid fa-heart"></i>
                                Wishlist
                            </a>                          
                            </li>
                            <li>
                              <a class="nav-link" href="/cart">
                                <i class="fas fa-shopping-cart"></i>
                                Cart
                              </a>                          
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/users/{{auth()->id()}}">
                                    <i class="fa-solid fa-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>
                              </button>
                              <ul class="dropdown-menu">
                                @foreach (auth()->user()->unreadNotifications as $notification)
                                  <li class="p-2">
                                    <a id="notification" href="{{$notification->data['url']}}">{{$notification->data['message']}}</a>
                                    <p>{{$notification->created_at->diffForHumans()}}</p>
                                    @if($notification->unread())
                                      <form method="POST" action="/notifications/{{$notification->id}}">
                                        @csrf
                                        <button type="submit" class="noti-readed">Mark as Read</button>
                                      </form>
                                    @endif
                                  </li>
                                @endforeach                         
                              </ul> 
                            </li>
                        @endcan
                          <li class="nav-item">
                              <form method="POST" action="/logout">
                                  @csrf
                                  <button type="submit" class="btn btn-link nav-link">
                                      <i class="fa-solid fa-door-closed"></i>
                                      Logout
                                  </button>
                              </form>
                          </li>                        
                        @else
                          <li class="nav-item">
                              <a class="nav-link" href="/register">
                                  <i class="fa-solid fa-user-plus"></i>
                                  Register
                              </a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="/login">
                                  <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                  Login
                              </a>
                          </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <x-flash-message />      
        <main>
               {{$slot}}
        </main>
        <footer class="text-center text-lg-start text-white mt-auto" style="background-color: #1b2838">
          <section class="d-flex justify-content-between p-4" style="background-color: #01497C">
            <div class="me-5">
              <span>Get connected with us on social networks:</span>
            </div>
            <div>
              <a href="https://www.facebook.com/profile.php?id=61554987592833" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://x.com/GoatGameSpace?t=qrZl6NZN8VpXHeSB-iZOgA&s=33" class="text-white me-4">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="https://www.google.com/search?q=snorlax+crying&tbm=isch&ved=2ahUKEwiB16Dbgp-DAxUipycCHcSWCNkQ2-cCegQIABAA&oq=snorlax+crying&gs_lcp=CgNpbWcQAzIECCMQJzIHCAAQgAQQEzoFCAAQgAQ6CggAEIAEEIoFEEM6BAgAEB46CAgAEAgQHhATUIoFWMwUYPIVaANwAHgAgAFciAGMB5IBAjExmAEAoAEBqgELZ3dzLXdpei1pbWfAAQE&sclient=img&ei=92SDZcH_OKLOnsEPxK2iyA0&authuser=0&bih=747&biw=1536&hl=pt-PT#imgrc=-1Bd7hSza4HYjM" class="text-white me-4">
                <i class="fab fa-google"></i>
              </a>
              <a href="https://www.instagram.com/gamespacegoat/" class="text-white me-4">
                <i class="fab fa-instagram"></i>
              </a>
            </div>
          </section>
          <section class="">
            <div class="container text-center text-md-start mt-5">
              <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                  <h6 class="text-uppercase fw-bold">GameSpace</h6>
                  <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #1b2838; height: 2px"/>
                  <p>
                    Copyright © 2023 GameSpace. All rights reserved.
                  </p>  
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                  <h6 class="text-uppercase fw-bold">Useful links</h6>
                  <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #1b2838; height: 2px"/>
                  <p>
                    <a href="{{auth()->user() ? '/users/' . auth()->id() : '/login'}}" class="text-white">Your Account</a>
                  </p>
                  <p>
                    <a href="/faqs" class="text-white">FAQ</a>
                  </p>
                  <p>
                    <a href="/about" class="text-white">About Us</a>
                  </p>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                  <h6 class="text-uppercase fw-bold">Contact</h6>
                  <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #1b2838; height: 2px"/>
                  <p><i class="fas fa-home mr-3"></i> Rua Dr. Roberto Frias, 4200-465 PORTO</p>
                  <p><i class="fas fa-envelope mr-3"></i> gamespace@email.com</p>
                </div>
              </div>
            </div>
          </section>
        </footer>
    </body>
</html>