<nav class="navbar is-primary">
  <div class="navbar-brand">
    <a class="navbar-item" style="font-size:14pt; font-weight: 700" href="{{url('')}}">
      Test Case
    </a>
    <div class="navbar-burger" data-target="navbarExampleTransparentExample">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="navbarExampleTransparentExample" class="navbar-menu">

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control is-flex is-align-items-center">
            Hi, <strong class="has-text-white">{{auth()->user()->first_name}}</strong>
          </p>
          <div class="control">
            <form action="{{route('logout')}}" method="POST">
              @csrf
              <button onclick="return confirm('Are you sure want to sign out?')" class="button is-danger" href="https://github.com/jgthms/bulma/releases/download/0.9.4/bulma-0.9.4.zip">
                <span class="icon">
                  <i class="fas fa-right-from-bracket"></i>
                </span>
              </button> 
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

@push('script')
    
@endpush