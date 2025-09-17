<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    {{-- Layout CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- Page Specific CSS --}}
    @stack('styles')

</head>
<body>
    {{-- SIDE BAR --}}
    <div class="side-container">
        <div class="title-container">
            <h1>Company Management System</h1>
        </div>
        <div class="image-container">
            <div class="image">
                <img src="{{ asset('images/phenskiee.jpg') }}" alt="image">
            </div>
            <div class="label-container">
                <p class="name">Stephen E. Espeño</p>
                <p class="applicant">PROGRAMMER</p>
            </div>
        </div>
        <div class="details-btn">
            <button id="viewDetails">View Details</button>
        </div>
        <nav>
            <ul>
                <li class="{{ request()->routeIs('index-page') ? 'links active' : 'links'}}">
                    <a href="{{ route('index-page') }}">
                        <i class="fa-solid fa-house-user"></i>
                        Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('company-page') ? 'links active' : 'links'}}">
                    <a href=" {{ route('company-page')}}">
                        <i class="fa-solid fa-list-check"></i>
                        Company List
                    </a>
                </li>
                <li class="{{ request()->routeIs('response-page') ? 'links active' : 'links'}}">
                    <a href="{{ route('response-page') }}">
                        <i class="fa-regular fa-bell"></i> 
                        Company Response
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    {{-- DETAILS INFORMATION CONTAINER --}}
    <div class="details-container" id="detailsContainer">
        <div class="details-content">
            <div class="view-close-btn"><i id="closeDetails" class="fa-solid fa-xmark"></i></div>
            <div class="view-content"><strong>Name:</strong> Stephen E. Espeño</div>
            <div class="view-content"><strong>Email: </strong>stephenespeno97@gmail.com</div>
            <div class="view-content"><strong>Phone Number: </strong>#0927-516-5347</div>
            <div class="view-content"><strong>Address:</strong> 777 Mercado St. Tondo Manila</div>
            <div class="view-content"><strong>Portfolio: </strong>https://phenskiee.vercel.app/</div>
            <div class="view-content">
                <strong>Introduction</strong>
                <p>
                    I am writing to express my interest in the Programming position at [Company Name]. As a recent graduate with a degree in Information Technolog, I have developed a solid foundation in software and web development. My academic background and project experience have equipped me with practical skills in PHP, JavaScript, Python, MySQL, MSSQL, and the Laravel framework.
    
                    I am eager to apply my knowledge in a professional setting and contribute meaningfully to your development team while continuing to grow as a programmer.
                </p>
            </div>
        </div>
    </div>
    
    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/modal.js') }}"></script>

    {{-- Page Specific JS --}}
    @stack('scripts')
    
</body>
</html>