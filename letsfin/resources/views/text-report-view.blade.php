@extends('admin.master.adminMaster')
@section('main-content')
<div id="layoutSidenav_content">
<main>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="{{ asset('ckeditor5/build/ckeditor.js')}}"></script>
  <script>
    function LoadEditor(){
      ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );

    }
    setTimeout(function() { LoadEditor(); }, 1000);   
    </script>
  <style>
    form {
      padding : 1.5em;
    }
    footer {
      display : none;
    }
    #form-container {
      border: 2px solid #ccc;
      padding: 50px;
      border-radius: 10px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      width: 50%;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    .radio-group {
      display: flex;
      justify-content: flex-start;
      margin-bottom: 10px;
    }

    .radio-group label {
      margin-right: 10px;
      display: inline-flex;
      align-items: baseline;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    label{
        font-weight:bold;
    }
    .ck-editor__editable {
      max-height: 200px;
    }
  </style>
@if($action=='Edit')
<form method="POST" action="{{route('edit-report')}}" >
@endif
@if($action=='Add')
<form method="POST" action="{{route('add-report')}}" >
@endif
      @csrf
      @if($action=='Edit')
        <input type="hidden" id="id" name="id" value="{{$id}}" />
      @endif
      <label for="report_code">Report Name:</label>
      <input type="text" id="report_code" name="report_code" value="{{$report_code ?? '' }}" required>  
    
      <label for="language_code">Language:</label>
      <select id="language_code" name="language_code" required>
        <option value="">--Select One--</option> <!-- Blank option -->
          @foreach($languages as $languagesel)
            <option value="{{ $languagesel->src_value }}" {{ $language_code == $languagesel->src_value ? 'selected' : '' }}>
              {{ $languagesel->mapped_value}}
            </option>
          @endforeach
      </select>

      <div class="radio-group">
        <label for="is_header">Is Header:</label>
        <label><input type="radio" id="is-header-yes" name="is_header" value="1" {{$is_header == 1 ||$is_header == '1' ? 'checked' : '' }}><span>Yes</span></label>
        <label><input type="radio" id="is-header-no" name="is_header" value="0" {{$is_header == 0 ||$is_header == '0' ? 'checked' : '' }}><span>No</span></label>
      </div>

      <div class="radio-group">
        <label for="is_footer">Is Footer:</label>
        <label><input type="radio" id="is-footer-yes" name="is_footer" value="1" {{$is_footer == 1 ||$is_footer == '1' ? 'checked' : '' }}>Yes</label>
       <label><input type="radio" id="is-footer-no" name="is_footer" value="0" {{$is_footer == 0 ||$is_footer == '0' ? 'checked' : '' }}>No</label>
      </div>

      <label for="header_ref">Header:</label>
      <select id="header_ref" name="header_ref">
        <option value="">--Select One--</option> <!-- Blank option -->
        @foreach($headers as $headersel)
          <option value="{{ $headersel->id }}" {{ $header_ref == $headersel->id ? 'selected' : '' }}>
            {{ $headersel->report_code}}
          </option>
        @endforeach
      </select>

      <label for="report-body">Report Body:</label>
      <textarea id="editor" name="report_content" rows="4">{{$report_content ?? '' }}</textarea>

      <label for="footer_ref">Footer:</label>
      <select id="footer_ref" name="footer_ref">
      <option value="">--Select One--</option> <!-- Blank option -->
        @foreach($footers as $footersel)
          <option value="{{ $footersel->id }}" {{ $footer_ref == $footersel->id ? 'selected' : '' }}>
            {{ $footersel->report_code}}
          </option>
        @endforeach
      </select>

      <button type="submit">Submit</button>
    </form>
  </div>
  </main>
  </div>
  </div>
  @endsection
