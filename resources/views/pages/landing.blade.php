@extends('layouts.app')
@section('title', 'Hawulz | Baca Berita Online')

@section('content')
    <!-- Swiper Banner -->
    <div class="swiper mySwiper mt-9">
      <div class="swiper-wrapper">
        @foreach ($banners as $banner)
          <div class="swiper-slide">
            <a href="detail-MotoGp.html" class="block">
              <div
                class="relative flex flex-col gap-1 justify-end p-3 h-72 rounded-xl bg-cover bg-center overflow-hidden"
                style="background-image: url('{{ asset('storage/' . $banner->news?->thumbnail) }}')"
              >
                <div class="absolute inset-x-0 bottom-0 h-full bg-gradient-to-t from-[rgba(0,0,0,0.6)] to-transparent rounded-b-xl"></div>

                <div class="relative z-10 mb-3 pl-2">
                  <div class="bg-primary text-white text-xs rounded-lg w-fit px-3 py-1 font-normal mt-3">
                    {{ $banner->news?->newsCategory?->title }}
                  </div>

                  <p class="text-2xl md:text-3xl font-semibold text-white mt-1">
                    {{ $banner->news?->title }}
                  </p>

                  <div class="flex items-center gap-2 mt-2">
                    <img
                      src="{{ asset('storage/' . $banner->news?->author?->avatar) }}"
                      alt=""
                      class="w-6 h-6 rounded-full object-cover"
                    >
                    <p class="text-white text-xs font-medium">
                      {{ $banner->news?->author?->name }}
                    </p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Berita Unggulan -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-10">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Berita Unggulan</p>
          <p class="text-slate-500 font-normal text-lg">Untuk Kamu</p>
        </div>
        <a href="semuaberita.html" class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit hover:opacity-90 transition">
          Lihat Semua
        </a>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach ($featureds as $featured)
          <a href="detail-MotoGp.html" class="block group">
            <div class="relative border border-slate-200 p-3 rounded-xl hover:border-primary transition duration-300 h-full flex flex-col justify-between">
              <div>
                <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-2 mt-2 text-xs absolute z-10">
                  {{ $featured->newsCategory?->title }}
                </div>
                <img src="{{ asset('storage/'. $featured->thumbnail) }}" alt="" class="w-full h-40 rounded-xl mb-3 object-cover group-hover:scale-[1.02] transition duration-300">
                <p class="font-bold text-base mb-1 line-clamp-2">{{ $featured->title }}</p>
              </div>
              <p class="text-slate-400 text-sm mt-2">{{ \Carbon\Carbon::parse($featured->created_at)->format('d M Y') }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>

    <!-- Berita Terbaru -->
    @if($news->isNotEmpty())
      <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-12">
        <div class="flex flex-col md:flex-row w-full mb-6">
          <div class="font-bold text-2xl text-center md:text-left">
            <p>Berita Terbaru</p>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5">
          <!-- Berita Utama (Kiri / Besar) -->
          <div class="relative lg:col-span-7 border border-slate-200 p-4 rounded-xl hover:border-primary transition duration-300">
            <a href="detail-MotoGp.html" class="block">
              <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-3 mt-3 absolute z-10 text-xs">
                {{ $news[0]->newsCategory?->title }}
              </div>
              <img src="{{ asset('storage/'. $news[0]->thumbnail) }}" alt="berita1" class="rounded-xl w-full h-72 object-cover">
              <p class="font-bold text-xl mt-4 hover:text-primary transition">    
                {{ $news[0]->title }}
              </p>
              <p class="text-slate-500 text-sm mt-2 line-clamp-2">
                {!! \Str::limit(strip_tags($news[0]->description ?? $news[0]->content), 120) !!}
              </p>
              <p class="text-slate-400 text-xs mt-3">{{ \Carbon\Carbon::parse($news[0]->created_at)->format('d M Y') }}</p>
            </a>
          </div>

          <!-- List Berita Sampingan (Kanan) -->
          <div class="lg:col-span-5 flex flex-col gap-4">
            @foreach ($news->skip(1) as $item)
              <a href="detail-MotoGp.html" class="relative flex flex-col sm:flex-row gap-3 border border-slate-200 p-3 rounded-xl hover:border-primary transition duration-300">
                <div class="bg-primary text-white rounded-full w-fit px-3 py-0.5 font-normal ml-2 mt-2 absolute z-10 text-xs">
                  {{ $item->newsCategory?->title }}
                </div>
                <img src="{{ asset('storage/'. $item->thumbnail) }}" alt="berita" class="rounded-lg w-full sm:w-36 h-32 object-cover">
                <div class="flex flex-col justify-between">
                  <div>
                    <p class="font-semibold text-base line-clamp-2">{{ $item->title }}</p>
                    <p class="text-slate-500 mt-1 text-xs line-clamp-2">
                      {!! \Str::limit(strip_tags($item->content ?? $item->description), 80) !!}
                    </p>
                  </div>
                  <p class="text-slate-400 text-xs mt-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
                </div>
              </a> 
            @endforeach
          </div>
        </div>
      </div>
    @endif

    <!-- Kenali Author -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-12">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Kenali Author</p>
          <p class="text-slate-500 font-normal text-lg">Terbaik Dari Kami</p>
        </div>
        <a href="register.html" class="bg-primary px-5 py-2 rounded-full text-white font-semibold mt-4 md:mt-0 h-fit hover:opacity-90 transition">
          Gabung Menjadi Author
        </a>
      </div>
      
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">
        @foreach ($authors as $author)
          <a href="author.html" class="block">
            <div class="flex flex-col items-center border border-slate-200 p-6 rounded-2xl hover:border-primary transition duration-300 text-center h-full">
              <img src="{{ asset('storage/'. $author->avatar) }}" alt="{{ $author->name }}" class="rounded-full w-20 h-20 object-cover">
              <p class="font-bold text-base mt-3 line-clamp-1">{{ $author->name }}</p>
              <p class="text-slate-400 text-xs mt-1">{{ $author->news?->count() ?? 0 }} Berita</p>
            </div>
          </a>  
        @endforeach
      </div>
    </div>

    <!-- Pilihan Author -->
    <div class="flex flex-col px-4 md:px-10 lg:px-14 mt-12 mb-16">
      <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
        <div class="font-bold text-2xl text-center md:text-left">
          <p>Pilihan Author</p>
        </div>
      </div>
      
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        @foreach ($news as $item)
          <a href="detail-MotoGp.html" class="block">
            <div class="relative border border-slate-200 p-3 rounded-xl hover:border-primary transition duration-300 h-full flex flex-col justify-between">
              <div>
                <div class="bg-primary text-white rounded-full w-fit px-4 py-1 font-normal ml-2 mt-2 text-xs absolute z-10">
                  {{ $item->newsCategory?->title }}
                </div>
                <img src="{{ asset('storage/'. $item->thumbnail) }}" alt="" class="w-full h-40 rounded-xl mb-3 object-cover">
                <p class="font-bold text-base mb-1 line-clamp-2">{{ $item->title }}</p>
              </div>
              <p class="text-slate-400 text-xs mt-2">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</p>
            </div>
          </a>
        @endforeach
      </div>
    </div>
@endsection