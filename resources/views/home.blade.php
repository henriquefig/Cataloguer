@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style='font-size:24px;' align='center'>{{ __('Home') }}</div>

                <div class="card-body home_card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        {{ __('Welcome to cataloguer!') }}
                        <br>
                        {{ __('Some quick links:') }}
                    <ul class='home_list'>
                        <li><a href='#' onclick='newcatalog()'>{{ __('Import a catalogue') }}</a></li>
                        <li><a href='#' onclick='mapping()'>{{ __('Catalogue mapping') }}</a></li>
                        <li><a href='#' onclick='listcatalog()'>{{ __('My catalogue entries') }}</a></li>
                        <li><a href='#' onclick='page_layout()'>{{ __('Catalogue layout') }}</a></li>
                        <li><a href='#' onclick='layouter()'>{{ __('Products\' layout') }}</a>
                        <li><a href='#' onclick='publish()'>{{ __('My published catalogue') }}</a></li>
                        <li><a target='_blank' href='{{str_replace("home","exported?u_id=".Auth::id(),Request::url())}}'>{{ __('Catalogue public link') }}</a></li>
                    </ul>
                    {{ __('These pages are always available throught the') }}&nbsp;&nbsp;<i style='padding:0.9%;background:black;color:white;' class='fa fa-lg fa-bars'></i>&nbsp;&nbsp;{{ __('on the top right corner.')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
