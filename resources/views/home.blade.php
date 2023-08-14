@extends('layouts.app')

@section('title')
    Discover Stunning Artwork
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($posts as $post)
            <div
                class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 transform hover:scale-105">
                <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                    <img src="{{ asset('uploads') . '/' . $post->image }}" alt="Post Image {{ $post->title }}"
                        class="w-full h-auto">
                </a>
                <div class="px-4 py-3">
                    <p class="text-gray-600">{{ $post->caption }}</p>
                </div>
                <div class="bg-gray-100 px-4 py-2 text-sm">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}"
                        class="text-blue-500 hover:underline hover:text-blue-600 transition-colors">
                        <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                    </a>
                </div>
            </div>
        @empty
        <p class="text-center text-gray-500 text-lg font-bold py-5">
            <span class="block">There's nothing to show</span>
            <span class="block mt-2">😞</span>
        </p>
        @endforelse
    </div>
    <div class="flex items-center justify-center mt-5">
        {{ $posts->links() }}
    </div>
@endsection
