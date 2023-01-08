@if(session()->has('message'))
    <div class="flash_message" x-data="{show: true}" x-init="setTimeout(()=>show=false,5000)" x-show="show">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif