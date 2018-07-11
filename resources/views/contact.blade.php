@extends('layouts.page')

@push('body-class', 'contact')

@section('content')
  <div class="full-height flex align-center">
      <div class="full-width">
          <form id="contact-form" class="container-small center p-2 card accent-border" action="{{ route('contact.store') }}" method="post">
              @method('POST')
              @csrf

              <div class="form-group">
                  <label for="name-input">Name<span class="required">*</span>:</label>
                  <input class="full-width input-inverse" type="text" name="name" id="name-input" value="">
                  @if ($errors->has('name'))
                    <span class="error">{{ $errors->first('name') }}</span>
                  @endif
              </div>

              <div class="form-group">
                  <label for="email-input">Email<span class="required">*</span>:</label>
                  <input class="full-width input-inverse" type="text" name="email" id="email-input" value="">
                  @if ($errors->has('email'))
                    <span class="error">{{ $errors->first('email') }}</span>
                  @endif
              </div>

              <div class="form-group">
                  <label for="message-input">Message<span class="required">*</span>:</label>
                  <textarea class="full-width input-inverse" name="message" id="message-input" rows="5"></textarea>
                  @if ($errors->has('message'))
                    <span class="error">{{ $errors->first('message') }}</span>
                  @endif
              </div>

              <button type="submit" class="btn full-width contact-btn">Send</button>

          </form>
      </div>
  </div>
@endsection
