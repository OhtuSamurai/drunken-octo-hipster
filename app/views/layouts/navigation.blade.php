
  <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><img src="images/oonapieni.png" class="img-rounded"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav nav-pills">
        <li><a href= {{route('committee.index')}} >Toimikunnat</a></li>
	@if(Auth::user())
        <li><a href={{action('UserController@active')}}>Pooli</a></li>
	@endif
        @if(Auth::user())
          @if(Auth::user()->is_admin)
            <li><a href= {{action('UserController@inactive')}}>Poolin ulkopuoliset käyttäjät</a></li>
        	<li><a href= {{route('poll.index')}} >Kyselyt</a></li>
		<li><a href="{{URL::to('/stats')}}">Tilastoja</a></li>
          @endif
          <li><a href={{action('UserController@show', array('id' => Auth::user()->id))}}>{{{Auth::user()->first_name}}}</a></li>
          <li><a href="{{URL::to('/logout')}}">Kirjaudu ulos</a></li>
        @else
          <li><a href="{{URL::to('/login')}}">Kirjaudu sisään</a></li>
        @endif
    </div>
  </div>
  </nav>
