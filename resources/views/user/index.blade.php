<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link href="css/basscss.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <nav class="clearfix">
            <div class="sm-col">
                <a href="/" class="button py2 button-transparent">Earlyme</a>
            </div>
            <div class="sm-col-right">
                <p class="inline-block">total late: 25 minutes total expand: 3655 bath</p>
                <div class="relative inline-block" data-disclosure>
                    <button type="button" class="button button-transparent">
                        <img src="{{ $user->avatar_url }}" class="circle" width="32" height="32" /> &#9662;
                    </button>
                    <div data-details class="fixed top-0 right-0 bottom-0 left-0"></div>
                    <div data-details class="absolute left-0 mt1 nowrap white bg-gray rounded">
                        <a href="#!" class="button block button-transparent">Setting</a>
                        <a href="{{ route('logout') }}" class="button block button-transparent">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="clearfix">
            <div class="col col-12">
                <form>
                    <label for="search">{{ date('d / m / Y', time()) }}</label>
                    <input id="search" type="time" class="field-light" name="time">
                    <button type="submit" class="button">Go</button>
                </form>
            </div>
        </div>

        <div class="clearfix mt1">
            <div class="col col-4">
                <p>9.24</p>
                <p>24 / 04 / 2015</p>
            </div>
            <div class="col col-4">
                <p>-</p>
            </div>
            <div class="col col-4">
                note
            </div>
        </div>

        <div class="clearfix mt1">
            <div class="col col-8">
                <p>9.35</p>
                <p>24 / 04 / 2015</p>
            </div>
            <div class="col col-4">
                <p>5 min</p>
            </div>
            <div class="col col-4">
                note
            </div>
        </div>
    </div>
    <script>
        var Disclosure = function(el, options) {
            el.isActive = false;
            el.details = el.querySelectorAll('[data-details]');
            el.hide = function() {
                for (var i = 0; i < el.details.length; i++) {
                    el.details[i].style.display = 'none';
                }
            };
            el.show = function() {
                for (var i = 0; i < el.details.length; i++) {
                    el.details[i].style.display = 'block';
                }
            };
            el.toggle = function(e) {
                e.stopPropagation();
                el.isActive = !el.isActive;
                if (el.isActive) {
                    el.show();
                } else {
                    el.hide();
                }
            }
            el.addEventListener('click', function(e) {
                el.toggle(e);
            });
            el.hide();
            return el;
        };

        var disclosures = document.querySelectorAll('[data-disclosure]');

        for (var i = 0; i < disclosures.length; i++) {
            disclosures[i] = new Disclosure(disclosures[i]);
        }

    </script>
</body>
</html>