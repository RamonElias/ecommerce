@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      {{-- {{ $api_token }} --}}
      {{-- {{ $product }} --}}
      <check-product-component
        api_token="{{ $api_token }}"
        :product="{{ $product }}"
        quantity-selected="{{ $quantitySelected }}"
      ></check-product-component>
    </div>
  </div>
@endsection

