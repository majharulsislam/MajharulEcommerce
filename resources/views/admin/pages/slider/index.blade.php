@extends('admin.layouts.master')

@section('admin_content')
<div class="row">
	<div class="col-md-12 grid-margin stretch-card">
    	<div class="card">
          <div class="card-body">
            <div class="row mmb-30">
            	<div class="col-md-10">
            		<h4 class="card-title">Manage Sliders</h4>
            	</div>

            	<div class="col-md-2">
            		<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addslider">Add Slider</a>
            	</div>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> #SL </th>
                  <th> Slider Title </th>
                  <th> Image </th>
                  <th> Button Text </th>
                  <th> Button Link </th>
                  <th> Priority </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>

                @foreach ($sliders as $key => $slider)
                <tr>
                  <td> {{ $key+1 }} </td>
                  <td> {{ $slider->title }} </td>
                  <td>
                    <img src="{{ asset('images/slider/'.$slider->image) }}" alt="Slider-image">
                  </td>
                  <td> {{ $slider->button_text }} </td>
                  <td> {{ $slider->button_link }} </td>
                  <td> {{ $slider->priority }} </td>

                  <td>
                  	<a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editslider{{ $slider->id }}"><i class="mdi mdi-eye"></i></a>

                  	<a href="{{ route('admin.slider.delete',$slider->id) }}" id="delete" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can-outline"></i></a>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
 	</div>
</div>


{{-- Modal Form For Add Slider --}}
<div class="modal fade" id="addslider" tabindex="-1" aria-labelledby="sliderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sliderModalLabel">Add New Slider</h5>
        <button type="button" data-dismiss="modal" aria-label="Close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data" file="true">
          @csrf

          <div class="mb-3">
            <label for="slider_title" class="col-form-label">Slider Title: <small style="color:red;">*</small></label>
            <input type="text" class="form-control" id="slider_title" name="slider_title" required>
          </div>

          <div class="mb-3">
            <label for="slider_subtitle" class="col-form-label">Slider Subtitle:</label>
            <input type="text" class="form-control" id="slider_subtitle" name="slider_subtitle">
          </div>

          <div class="mb-3">
            <label for="button_text" class="col-form-label">Button Text:</label>
            <input type="text" class="form-control" id="button_text" name="button_text">
          </div>

          <div class="mb-3">
            <label for="button_link" class="col-form-label">Button Url:</label>
            <input type="text" class="form-control" id="button_link" name="button_link">
          </div>

          <div class="mb-3">
            <label for="slider_priority" class="col-form-label">Priority: <small style="color:red;">*</small></label>
            <input type="text" class="form-control" id="slider_priority" name="slider_priority" required>
          </div>

          <div class="mb-3">
            <label for="slider_image" class="col-form-label">Slider Image: <small style="color:red;">*</small></label>
            <input type="file" class="form-control" id="slider_image" name="slider_image" required>
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


{{-- Modal Form for Edit Slider --}}
@foreach ($sliders as $slider)
<div class="modal fade" id="editslider{{ $slider->id }}" tabindex="-1" aria-labelledby="editsliderModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editsliderModalLabel">Edit Slider</h5>
        <button type="button" data-dismiss="modal" aria-label="Close"><span class="mdi mdi-close"></span></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" file="true">
          @csrf

          <div class="mb-3">
            <label for="slider_title" class="col-form-label">Slider Title: <small style="color:red;">*</small></label>
            <input type="text" class="form-control" id="slider_title" name="slider_title" value="{{ $slider->title }}" required>
          </div>

          <div class="mb-3">
            <label for="slider_subtitle" class="col-form-label">Slider Subtitle:</label>
            <input type="text" class="form-control" id="slider_subtitle" name="slider_subtitle" value="{{ $slider->sub_title }}">
          </div>

          <div class="mb-3">
            <label for="button_text" class="col-form-label">Button Text:</label>
            <input type="text" class="form-control" id="button_text" name="button_text" value="{{ $slider->button_text }}">
          </div>

          <div class="mb-3">
            <label for="button_link" class="col-form-label">Button Url:</label>
            <input type="text" class="form-control" id="button_link" name="button_link" value="{{ $slider->button_link }}">
          </div>

          <div class="mb-3">
            <label for="slider_priority" class="col-form-label">Priority: <small style="color:red;">*</small></label>
            <input type="text" class="form-control" id="slider_priority" name="slider_priority" value="{{ $slider->priority }}" required>
          </div>

          <div class="mb-3">
            <label class="col-form-label">Previous Image:</label>
            <img src="{{ asset('images/slider/'.$slider->image) }}" alt="slider-old-image" width="100px" height="60px">
          </div>

          <div class="mb-3">
            <label for="slider_image" class="col-form-label">Slider New Image: <small style="color:red;">*</small> </label>
            <input type="file" class="form-control" id="slider_image" name="slider_image">
          </div>

          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection




