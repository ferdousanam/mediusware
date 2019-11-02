@extends('layouts.app')
@section('content')
    <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    {{--    <link rel="stylesheet" href="{{ asset('datepicker/css/bootstrap-datepicker.min.css') }}"/>--}}
    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css"/>

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <div class="container-fluid app-body">
        <div class="row">
            <form method="get" action="{{ route('new.store') }}" id="myForm">
                <div class="col-md-3 form-group">
                    <input type="text" name="search" placeholder="Search" class="form-control">
                </div>
                <div class="col-md-3 form-group">
                    <input class="form-control datepicker" name="date" data-date-format="yyyy-mm-dd">
                </div>
                <div class="col-md-3 form-group">
                    <select name="group" id="group" class="form-control">
                        <option value="">All Groups</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->type }}">{{ $group->type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 form-group">
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                </div>

            </form>

        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th scope="col">Group Name</th>
                    <th scope="col">Group Type</th>
                    <th scope="col">Account Name</th>
                    <th scope="col">Post Text</th>
                    <th scope="col">Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->groupInfo->name }}</th>
                        <th>{{ $post->groupInfo->type }}</th>
                        <th class="content-center"><img width="50" class="media-object img-circle"
                                                        src="{{ $post->accountInfo->avatar }}" alt=""></th>
                        <th>{{ $post->post_text }}</th>
                        <th>{{ \Carbon\Carbon::parse($post->sent_at)->format('d M, Y h:i a') }}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $posts->links() }}
        </div>
    </div>
{{--    <script src="{{ asset('datepicker/js/bootstrap-datepicker.min.js') }}"></script>--}}
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                }
            );

            $('#group').change(function () {
                console.log('change');
                $('#myForm').submit();
            });
        });
    </script>
@endsection
