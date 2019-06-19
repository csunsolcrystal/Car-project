<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body >
  <nav class="navbar navbar-dark bg-dark">
    <div class="container"> <a class="navbar-brand" href="#">
        <i class="fa d-inline fa-lg fa-circle"></i>
        <b> Carwraps</b>
      </a> </div>
  </nav>
  <div class="py-5 text-center" style="background-image: linear-gradient(to left bottom, rgba(189, 195, 199, .75), rgba(44, 62, 80, .75)); background-size: 100%;">
    <div class="container">
      <div class="row">
        <div class="mx-auto col-md-6">
          <h1>Finding the perfect size for your car</h1>
          <p class="mb-4 text-body">Search by model, maker, and/or year</p>
          <form class="form-inline d-flex justify-content-center">
            <div class="input-group">
              <input type="text" class="form-control d-inline-flex justify-content-center" placeholder="Search" style="width: 350px;" id="inlineFormInputGroup">
              <div class="input-group-append"><button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Or find your car below</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="align-items-center text-center mb-5">
    <div class='container' id="app">
      <example-component :initial-years="{{ json_encode($years) }}" ></example-component>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h2 class="">Year</h2><select class="browser-default custom-select">
            <option selected="" value="Year">Choose Year</option>
			@foreach ($years as $year)
			 <option value="{{ $year['Year'] }}">{{ $year['Year'] }}</option>
			@endforeach
          </select>
        </div>
        <div class="col-md-3">
          <h2 class="">Maker</h2><select class="browser-default custom-select">
            <option selected="" value="Year">Choose Maker</option>
         	@foreach ($makers as $maker)
			 <option value="{{ $maker['Make'] }}">{{ $maker['Make'] }}</option>
			@endforeach
          </select>
        </div>
        <div class="col-md-3">
          <h2 class="">Model</h2><select class="browser-default custom-select">
            <option selected="" value="Year">Choose Model</option>
            @foreach ($models as $model)
			 <option value="{{ $model['Model'] }}">{{ $model['Model'] }}</option>
			@endforeach
          </select>
        </div>
        <div class="col-md-3">
          <h2 class="">Trim</h2><select class="browser-default custom-select">
			   <option selected="" value="Year">Choose Trim</option>
           	@foreach ($trims as $trim)
			 <option value="{{ $trim['Trim'] }}">{{ $trim['Trim'] }}</option>
			@endforeach
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="text-center pb-2">Vinyl Wrap&nbsp;<small class="text-muted"><br>The length of the vinyl wrap needed is an approximation based on skilled level</small></h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered ">
              <thead class="thead-dark">
                <tr>
                  <th>Tier List (Skill level)</th>
                  <th>Approximate Length</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>Novice</th>
                  <td>10"</td>
                </tr>
                <tr>
                  <th>Intermediate</th>
                  <td>8"</td>
                </tr>
                <tr>
                  <th scope="row" contenteditable="true">Professional</th>
                  <td>5"</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="mb-0">&copy; 2014-2018 Carwraps. All rights reserved</p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
