@extends('layouts.page')

@push('body-class', 'contact')

@section('content')
  <div class="full-height flex align-center">
      <div class="full-width">
          <form id="contact-form" class="container-small center p-2 card accent-border">
              <div class="form-group">
                  <label for="name-input">Name:</label>
                  <input class="full-width input-inverse" type="text" name="name" id="name-input" value="">
              </div>
              <div class="form-group">
                  <label for="email-input">Email:</label>
                  <input class="full-width input-inverse" type="text" name="email" id="email-input" value="">
              </div>
              <div class="form-group">
                  <label for="message-input">Message:</label>
                  <textarea class="full-width input-inverse" name="message" id="message-input" rows="5"></textarea>
              </div>
              <button type="submit" class="btn full-width contact-btn">Send</button>
          </form>
      </div>
  </div>
@endsection
