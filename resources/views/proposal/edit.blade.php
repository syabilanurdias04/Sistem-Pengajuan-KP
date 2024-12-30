@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Proposal</h1>
    <form action="{{ route('proposal.update', $proposal) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="draft">Draft Proposal</label>
            <textarea name="draft" class="form-control" required>{{ $proposal->draft }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Proposal</button>
    </form>
</div>
@endsection