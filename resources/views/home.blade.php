@extends('layouts.page')

@push('body-class', 'home')

@section('content')
  <div class="full-width full-height center flex flex-column justify-center text-center">

    <img class="img-profile img-rounded center mt-1" src="img/mychal-calderon.jpg" alt="Mychal Calderon" />
    
    <h1>Mychal Calderon</h1>
    
    <h2>Web Developer</h2>

    <p class="card container-small center p-2 my-1">From a young age, I have had an insatiable desire to learn how things work. As such, it's no surprise that my first ventures into the world of programming came about because I wanted to know how video games were made. Luckily, my high school offered several programming classes and I've been hooked ever since. After over a decade of coding, my desire to learn and enthusiasm for the field has only grown. When I'm not trying to improve my coding skills, I enjoy spending time with my family, playing video games, reading a good book, and drawing.</p>

    <a href="{{ route('contact') }}" class="btn contact-btn center">Get in touch</a>

    <ul class="social my-1">
      <li><a href="https://twitter.com/mykecalderon" title="Follow Mychal on Twitter" target="https://twitter.com/mykecalderon"><i class="fab fa-twitter"></i></a></li>
      <li><a href="https://github.com/mykecalderon" title="View and contribute to Mychal's projects on GitHub" target="https://github.com/mykecalderon"><i class="fab fa-github"></i></a></li>
    </ul>

  </div>
@endsection
