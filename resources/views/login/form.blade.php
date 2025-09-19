@include('includes.header')

@if($mensagem = Session::get('erro'))
  {( $mensagem )}
@endif

@if($errors->any())
  @foreach($errors->all() as $error)
    {{ $error }} <br>
  @endforeach
@endif

<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-6 col-lg-6 col-md-6">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">


                  <div class="text-center">
                    <!-- Imagem no topo -->
                    <img src="{{ asset('assets/img/logo.jpg') }}" alt="Logo">

                    <br><br>
                    <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                  </div>


                </div>

                <form class="user" action="{{ route('login.auth') }}" method="POST">
                  @csrf

                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user"
                      placeholder="Enter Email Address...">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user"
                      placeholder="Password">
                  </div>

                  <button type="submit" class="btn btn-primary btn-user btn-block"> Entrar </button>
                  <hr>
                </form>


              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

@include('includes.scripts')