@extends('layouts.app')

@section('content')
    <h1>Edit Section</h1>

    <form action="{{ route('sections.update', $section->id) }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="section_name">Section Name</label>
            <input type="text" name="section_name" id="section_name" value="{{ $section->section_name }}" required>
        </div>
    
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="3">{{ $section->description }}</textarea>
        </div>
    
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    
@endsection
