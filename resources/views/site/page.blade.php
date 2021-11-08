@extends('layouts.app', ['title' => $page->title])

@section('content')

    <section class="main-bg-shop">
        <div class="cont-1194">
            <div class="bread-crumbs">
                <ul class="ul-ppm">
                    <li><a href="/" class="bread-crumb">Main</a></li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cont-1194 mr-b-240">
        <div class="cont-mc">
            <div class="cont-mm-w">
                <h2>{{ $page->getTranslatedAttribute('title', app()->getLocale(), 'fallbackLocale') }}</h2>
            </div>
        </div>
        <div class="cont-mm-h-c">
            {!! $page->getTranslatedAttribute('body', app()->getLocale(), 'fallbackLocale') !!}
        </div>

    </div>

@endsection
