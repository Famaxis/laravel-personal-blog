@extends('layouts.backend')

@section('content')

    <div class="form-group margin-top">
        <a class="paper-btn" href="{{ route('templates.create') }}">Create template</a>
    </div>
    <table class="table-alternating">
        <thead>
        <th>Name</th>
        <th>Description</th>
        <th>File</th>
        <th>Css</th>
        <th>Js</th>
        <th>Action</th>
        </thead>
        <tbody>
        @foreach($templates as $template)
            <tr>
                <td>{!! $template->name !!}</td>
                <td>{!! $template->description!!}</td>
                <td>{!! "$template->file.blade.php" !!}</td>
                <td>{!! $template->css !!}</td>
                <td>{!! $template->js !!}</td>
                <td>
{{--                    <a href="{{ route('front.templates.show',$template->id) }}" class="paper-btn btn-secondary-outline">Read</a>--}}
                    <a href="{{ route('templates.edit', $template->id) }}" class="paper-btn btn-success-outline">Edit</a>
                    <form action="{{route('templates.destroy', $template->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="paper-btn btn-danger-outline"
                                @if($settings->confirm_deletion)
                                onclick="return confirm('Are you sure?')"
                                @endif
                        >Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $templates->links() !!}
@endsection