
  <nav class="navbar navbar-inverse" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><img src="/images/oonapieni.png" class="img-rounded"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/pooli">Pooli</a></li>
        <li><a href= {{route('poll.index')}} >Kyselyt</a></li>
        @if(Auth::user())
        <li><a href="#">Kirjautunut: {{{Auth::user()->first_name}}}</a></li>
        <li><a href="/logout">Kirjaudu ulos</a></li>
        @else
        <li><a href="/login">Kirjaudu sisään</a></li>
        @endif
    </div>
  </div>
  </nav>
