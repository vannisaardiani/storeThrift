@extends('layouts.app')
@section('title', 'Search Results')

@section('content')
<div class="row">
  @if ($products->isEmpty())
    <div class="col-12 text-center">
      <h3>No products found for your search query.</h3>
    </div>
  @else
    @foreach ($products as $product)
    <div class="col-md-4 col-lg-3 mb-2">
      <div class="card">
        <img src="{{ asset('/storage/' . $product->getImage()) }}" class="card-img-top img-card">
        <div class="card-body text-center">
          <a href="{{ route('product.show', ['id'=> $product->id]) }}" class="btn bg-primary text-white">
            {{ $product->name }}
          </a>
        </div>
      </div>
    </div>
    @endforeach
  @endif
</div>
@endsection
