@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @if ($message = session('charged-message'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
      @endif

      <checkout-component
        api_token="{{ $api_token }}"
        :cart_items="{{ $cart_items }}"
      ></checkout-component>
  </div>
@endsection
