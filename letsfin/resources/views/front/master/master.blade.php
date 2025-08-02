@if (Session::has('language') && Session::get('language')=="Hi")
@include('front.master.hindi-master')
  
@elseif (Session::has('language') && Session::get('language')=="en")
@include('front.master.english-master')

@endif

@if (!Session::has('language'))
@include('front.master.english-master')
    
@endif
