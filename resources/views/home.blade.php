@extends('layouts.page')

@push('body-class', 'home')

@section('content')
  <div class="container">

    <img src="img/mychal_calderon.jpg" alt="Mychal Calderon" />
    
    <h1>Mychal Calderon</h1>
    
    <h2>Web Developer</h2>

    <p>Currently obsessed with Laravel, Vue.js, and TDD.</p>

    <a href="/contact" class="btn contact-btn">Get in touch</a>

    <ul class="social">
      <li><a href="http://twitter.com/mykecalderon" title="Follow Mychal on Twitter" target="https://twitter.com/mykecalderon"><i class="fab fa-twitter"></i></a></li>
      <li><a href="http://github.com/mykecalderon" title="View and contribute to Mychal's projects on GitHub" target="https://github.com/mykecalderon"><i class="fab fa-github"></i></a></li>
    </ul>

  </div>
@endsection
