@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end mb-5">
        <div class="col-2">
            <a href="{{ action([\App\Http\Controllers\TasksController::class, 'create'])}}" type="button" class="btn btn-primary">{{ __('Create') }}</a>
        </div>
    </div>


    <div class="row justify-content-center mb-2">
        <div class="col-8">
            <nav class="navbar-expand-lg bg-body-tertiary">
                <form class="d-flex" role="search" action="{{ action([\App\Http\Controllers\HomeController::class, 'index']) }}" id="searchForm">
                    <div class="container-fluid px-0">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item" style="margin-right: 1rem;">
                                    <select name="status" class="form-select" aria-label="Default select example">
                                        <option selected value="{{ null }}">{{ __('Filter status') }}</option>
                                        @foreach(\App\Models\Task::STATUSES as $name => $status)
                                            <option value="{{ $status }}"
                                                {{ request()->get('status') == $status ? 'selected' : '' }}>
                                                {{ __($name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                                <li class="nav-item">
                                    <select name="priority" class="form-select" aria-label="Default select example">
                                        <option selected value="{{ null }}">{{ __('Filter priority') }}</option>
                                        @foreach(\App\Models\Task::PRIORITIES as $name => $priority)
                                            <option value="{{ $priority }}"
                                                {{ request()->get('status') == $status ? 'selected' : '' }}>
                                                {{ __($name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <input name="term" value="{{ request()->get('term') }}" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">{{ __('Search') }}</button>
                </form>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('STATUS') }}</th>
                            <th scope="col">{{ __('TITLE') }}</th>
                            <th scope="col">{{ __('DESCRIPTION') }}</th>
                            <th scope="col">{{ __('PRIORITY') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($tasks as $item)
                           <tr class="{{ $item->priority_class }}">
                               <td>
                                   <button
                                       style="font-size: 12px; width: 6rem;"
                                       type="button"
                                       class="btn py-0 px-2 @if(\App\Models\Task::STATUSES['UNFINISHED'] === $item->status) btn-danger @else btn-success @endif">
                                       {{ \App\Models\Task::STATUSES['UNFINISHED'] === $item->status ? __('UNFINISHED') : __('FINISHED') }}
                                   </button>
                               </td>
                               <td>{{ $item->title }}</td>
                               <td>{{ $item->description }}</td>
                               <td>
                                  @if($item->priority)
                                       <button
                                           style="font-size: 12px; width: 5rem"
                                           class="btn py-0 px-3 {{ $item->priority_class }}">
                                           {{ $item->priority_name }}
                                       </button>
                                  @endif
                               </td>
                               <td>
                                   <div class="dropdown">
                                       <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                       <ul class="dropdown-menu">
                                           <li>
                                               <a
                                                   href="{{ action([\App\Http\Controllers\TasksController::class, 'edit'], ['task' => $item->id]) }}"
                                                   class="dropdown-item" type="button">{{ __('Edit') }}
                                               </a>
                                           </li>
                                           <li>
                                               <form action="{{ action([\App\Http\Controllers\TasksController::class, 'destroy'], ['task' => $item->id]) }}"
                                                     method="POST"
                                               >
                                                   @csrf
                                                   @method('DELETE')
                                                   <button type="submit" class="dropdown-item" type="button"
                                                       >
                                                       {{ __('Delete') }}
                                                   </button>
                                               </form>
                                           </li>
                                       </ul>
                                   </div>
                               </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
