@extends('layouts.admin')

@section('head-title')
    @yield('page-title')
@endsection


@section('main-content')
    <div class="container">
        <div class="row">

            <div class="col-12">

                @include('partials.errors')
                {{-- @dump($technologies) --}}

                <form action="@yield('form-action')" method="POST" enctype="multipart/form-data">
                    @csrf

                    @yield('form-method')


                    <div class="mb-3 input-group">
                        <label for="title" class="input-group-text"> Title:</label>
                        <input class="form-control" type="text" name="title" id="title"
                            value="{{ old('title', $project->title) }}">
                    </div>


                    <div class="mb-3 input-group">
                        <label for="type_id" class="input-group-text">Type</label>
                        <select class="form-select" type="text" name="type_id" id="type_id">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 input-group">
                        <label for="image" class="input-group-text">Upload a project image</label>
                        <input class="form-control" type="file" name="image" id="image"
                            value="{{ old('image', $project->image) }}">
                        <div>
                            <img src="" alt="image preview" class="d-none img-fluid " id="image-preview">
                        </div>
                    </div>

                    <div class="mb-3 input-group">
                        <div>
                            @foreach ($technologies as $technology)
                                <input class="form-check-input" type="checkbox" name="technologies[]" id="technologies-{{$technology->id}}"
                                    value="{{ $technology->id }}"
                                    {{ in_array( $technology->id, old('technologies', $project->technologies->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label for="technologies-{{ $technology->id }}">{{ $technology->name }}</label>
                            @endforeach

                        </div>
                    </div>

                    <div class="mb-3 input-group">
                        <label for="date" class="input-group-text"> Date:</label>
                        <input class="form-control" type="text" name="date" id="date"
                            value="{{ old('date', $project->date) }}">
                    </div>

                    <div class="mb-3 input-group">
                        <label for="description" class="input-group-text"> Description:</label>
                        <textarea class="form-control" type="text" name="description" id="description"> {{ old('description', $project->description) }}</textarea>
                    </div>



                    <button type="submit" class="btn btn-sm btn-primary">
                        @yield('page-title')
                    </button>

                    <button type="reset" class="btn btn-sm btn-warning">
                        Reset Form
                    </button>

                </form>









            </div>
        </div>

    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const imageElement = document.getElementById('image-preview');
            imageElement.setAttribute('src', this.value);
            imageElement.classList.remove('d-none');
        });
    </script>
@endsection
