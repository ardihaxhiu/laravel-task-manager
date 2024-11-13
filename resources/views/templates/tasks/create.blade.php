@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center mb-5">{{ __('Create Task') }}</h1>
            <div class="col-8">
                <form
                    action="{{ action([\App\Http\Controllers\TasksController::class, isset($item) ? 'update' : 'store'],
                            isset($item) ? ['task' => $item->id]: []) }}"
                    method="POST"
                >
                    @csrf
                    @method(isset($item) ? 'PATCH' : 'POST')
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('Title') }}</label>
                        <input type="text"
                               class="form-control"
                               name="title"
                               id="title"
                               placeholder="{{ __('Title') }}"
                               value="{{ isset($item) ? $item->title : null }}"
                        >
                        @error('title')
                            <div class="text-center mt-2">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <textarea class="form-control"
                                  name="description"
                                  id="description" rows="3">{{ isset($item) ? $item->description : null }}</textarea>
                        @error('description')
                            <div class="text-center mt-2">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select name="status" class="form-select" aria-label="{{ __('Status') }}">
                            @foreach(\App\Models\Task::STATUSES as $key => $status)
                                <option
                                    value="{{ $status }}" @if(isset($item) && $status === $item->status)
                                    {{ 'selected' }} @endif>{{ __($key) }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="text-center mt-2">
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <select name="priority" class="form-select" aria-label="{{ __('Priority') }}">
                            <option selected value="{{ null }}">{{ __('PRIORITY') }}</option>
                            @foreach(\App\Models\Task::PRIORITIES as $key => $priority)
                                <option value="{{ $priority }}">{{ __($key) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
