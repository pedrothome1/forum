@extends('layouts.app')

@section('content')
    <thread-view :thread="{{ $thread }}" :best-reply="{{ $bestReply }}" inline-template v-cloak>
        <transition name="fade">
            <div class="row" v-show="show">
                <div class="col-md-8">
                    <div v-if="page === 1">
                        @include('threads.thread')

                        <best-reply v-if="solved" :reply="best"></best-reply>
                    </div>

                    <replies :thread-solved="solved" @loaded="show = true"></replies>
                </div>

                <div class="col-md-4">
                    @include('layouts.sidebar')
                </div>
            </div>
        </transition>
    </thread-view>
@endsection
