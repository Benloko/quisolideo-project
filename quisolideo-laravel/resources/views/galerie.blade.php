@extends('layouts.app')

@section('content')
<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-4">Galerie</h1>
    <?php
      $images = glob(public_path('assets/gallery/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE) ?: [];
    ?>

    @if(count($images))
      <div class="row g-3">
        @foreach($images as $img)
          <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ asset('assets/gallery/' . basename($img)) }}" target="_blank" class="d-block">
              <div class="card shadow-sm" style="border-radius:10px;overflow:hidden;">
                <img src="{{ asset('assets/gallery/' . basename($img)) }}" class="w-100" style="height:180px;object-fit:cover;">
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-secondary">Aucune image disponible pour le moment.</div>
    @endif

  </div>
</section>
@endsection
