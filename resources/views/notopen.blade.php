@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="font-semibold text-xl">{{__('The Palapa is now closed for on-line orders')}}</h4>
        </div>
    </div>

    @if ($special)
    <aside id="popUp" class="popup">
        <div class="popUpContainer">
            <header>
                <a href="#!" class="closePopUp">X</a>
                <h2>{{$special_title}}</h2>
            </header>
            <article>
                <p>{{$special_message}}</p>
            </article>
        </div>
        <a href="#!" class="closePopUpOutSide"></a>
    </aside>
@endif
    @include('partials.menu')
</div>

<script>
    const closeModal = document.querySelector('.closePopUp');
    const modal = document.querySelector('#popUp');

    if (modal) {
            closeModal.addEventListener('click', ()=> {
            modal.style.display="none";
        });
    }
</script>

@endsection