<!DOCTYPE html>
<html>

<head>
@section ('head')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />

    <link href={{ asset("assets/site/Bootstrap/styles/bootstrap.min.css") }} rel="stylesheet" />
    <script src={{ asset("assets/site/Bootstrap/js/jquery-1.11.1.min.js") }} ></script>
    <script src={{ asset("assets/site/Bootstrap/js/bootstrap.min.js") }} ></script>
    <script src="{{ asset("assets/site/js/jsFun.js")}}" type="text/javascript" ></script>
    <link href={{ asset("assets/site/css/StyleSheet.css") }} rel="stylesheet" />
    <link href={{ asset("assets/site/css/ColorStyle.css") }} rel="stylesheet" />

  <title>{{$title}}</title>
@show

</head>

<body>

<!--------------------------------------------------------------->
@section ('header')
<header >
    <div class="container" id="Top">
        <div class="row" >
            <div class="col-md-6">
                <p class="topText">8(800)00-00-000</p>
            </div>
            <div class="col-md-6 text-right">
                <p class="topText">mail@mail.ru</p>
            </div>
        </div>
    </div>
</header>
@show
<!--------------------------------------------------------------->



<main >


    <article >

        @yield('navbar')

        @yield('content')


    </article>

</main>


<!--При прокрутке отображает скрытое меню-->
<script>
    $(document).ready(function() {
        $(function(){
            $(window).on("scroll", function() {
                if ($(window).scrollTop() > 47) $('#navHidden').css('visibility', 'visible');
                else $('#navHidden').css('visibility', 'hidden');
            });
        });
    });
</script>

<!--------------------------------------------------------------->
@section ('footer')
<footer class="row center-block" id="footer">
    <p class="text-center">
        Коломоец Андрей гр. ППС 31-01
        <br />
        <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span>
        &nbsp 2019
    </p>
</footer>
@show



</body>
</html>
