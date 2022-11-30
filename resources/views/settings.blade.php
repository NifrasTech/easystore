@extends('layouts/contentLayoutMaster')

@section('title', 'Settings')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/dropify/dropify.min.css')}}">
@endsection
@section('content')
<!-- Basic Vertical form layout section start -->
<section id="basic-vertical-layouts">
  <div class="row">
    <div class="col-md-12 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Application Settings</h4>
        </div>
        <div class="card-body">
          <form 
          class="form form-setting" 
          action="{{route('store-settings')}}" 
          method="POST"
          enctype="multipart/form-data">
          @CSRF
            <div class="row">
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label">Store Name</label>
                  <input
                    type="text"
                    class="form-control"
                    name="store_name"
                    placeholder="Store Name"
                    required=""
                    value="{{$settings->store_name}}"
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label">Contact No</label>
                  <input
                    type="text"
                    class="form-control"
                    name="contact_no"
                    placeholder="Contact No"
                    required=""
                    value="{{$settings->contact_no}}"
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    name="email"
                    placeholder="Email..."
                    required=""
                    value="{{$settings->email}}"
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label">Address</label>
                  <input
                    type="text"
                    class="form-control"
                    name="address"
                    placeholder="Address"
                    required=""
                    value="{{$settings->address}}"
                  />
                </div>
              </div>
              <div class="col-12">
                <div class="mb-1">
                  <label class="form-label">Bill Note</label>
                  <input
                    type="text"
                    class="form-control"
                    name="bill_note"
                    placeholder="Bill Note..."
                    required=""
                    value="{{$settings->bill_note}}"
                  />
                </div>
              </div>
              <div class="col-12">
              <label>Store Logo <small class="text-primary">*please upload png logo with 1:1 aspect ratio</small></label>
							          <input type="file" name="logo" id="image" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset('thumbnail/'.$settings->logo)}}"  data-max-file-size="1M"/>       
                @error('logo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror  
            </div>
              <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Basic Vertical form layout section end -->
@endsection

@section('vendor-script')
<script src="{{asset('vendors/dropify/dropify.min.js')}}"></script>
@endsection

@section('page-script')
<script>
$(document).ready(function() {
  $('.dropify').dropify()
  // Used events
  var drEvent = $('#input-file-events').dropify();

  drEvent.on('dropify.beforeClear', function(event, element) {
      return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
  });

  drEvent.on('dropify.afterClear', function(event, element) {
      alert('File deleted');
  });

  drEvent.on('dropify.errors', function(event, element) {
      console.log('Has Errors');
  });

  var drDestroy = $('#input-file-to-destroy').dropify();
  drDestroy = drDestroy.data('dropify')
  $('#toggleDropify').on('click', function(e) {
      e.preventDefault();
      if (drDestroy.isDropified()) {
          drDestroy.destroy();
      } else {
          drDestroy.init();
      }
  })
})
</script>
@endsection