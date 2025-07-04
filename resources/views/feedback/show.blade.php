@extends('layouts.app')

@section('title', 'View Feedback')

@section('content')
     <!-- View -->
     <a href="{{ route('feedback.show', ['feedback' => $feedback->id]) }}"
        class="text-blue-600 hover:underline text-sm">
         View
     </a>

     <!-- Delete -->
     <form method="POST"
           action="{{ route('feedback.destroy', ['feedback' => $feedback->id]) }}"
           onsubmit="return confirm('Are you sure you want to delete this feedback?');">
         @csrf
         @method('DELETE')
         <button type="submit" class="text-red-600 hover:underline text-sm">
             Delete
         </button>
     </form>

@endsection
