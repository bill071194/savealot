@extends('layouts.base')

@section('title', 'Save-a-lot Upload Picture')

@section('main')

<div class="row">
    <div class="col col-md-8 offset-md-2">
        <div class="card h-100 shadow border-dark rounded-4">
            <form method="POST" action="uploadpicture" enctype="multipart/form-data">
                @csrf
                <div class="card-header text-center h1">Upload a Product Image</div>
                <div class="card-body">
                    <div class="mb-1 mb-sm-3 col-8 col-sm-8">
                		<label for="image_upload">Upload Image File</label>
                        <input id="image_upload" type="file" class="form-control @error('picture_upload') is-invalid @enderror" name="image" value="{{old('image')}}">
            		</div>
            	</div>
                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="../inventory"><button type="button" class="btn btn-secondary mx-3 rounded-5">Close</button></a>
                    <input type="submit" class="btn btn-primary rounded-5" value="Upload">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection