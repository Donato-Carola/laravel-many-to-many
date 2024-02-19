@extends('layouts.admin')

@section('title', 'Admin Projects')

@section('main-content')
    <div class="container">
        <div class="row">


            <div class="col-12">

                <h2 scope="row">
                    {{ $project->id }}
                </h2>
                <p>

                        {{ $project->title }}
                </p>

                @include('partials.session-message')
                
                <ul>
                    @forelse ($project->technologies as $technology)
                        <li class="d-inline me-3">
                            <span class="badge px-2 px-1" style="background-color: {{ $technology->color }} ">
                                {{ $technology->name }}
                            </span>
                        </li>

                    @empty
                        <li class="d-inline me-3">
                            This post has no technologies yet...
                        </li>
                    @endforelse
                </ul>
                @if (str_starts_with($project->image, 'http'))
                <img src="{{$project->image}}" alt="">
                @else
               <img src="{{asset('storage') . '/' . $project->image}}" alt="">

                @endif
                <p>{{ $project->user->name }}</p>
                <p>{{$project->type->name}}</p>
                <p>{{ $project->description }}</p>
                <p>{{ $project->date }}</p>

                <p>



                </p>

            </div>
        </div>

    </div>


@endsection
