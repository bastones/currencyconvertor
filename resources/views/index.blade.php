<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>Currency Convertor</title>
</head>
<body>
    <div class="container">
        <form>
            <div class="row pt-4 pb-4">
                <div class="col-lg-3 pt-2 pb-2">
                    <div class="input-group">
                        <span class="input-group-addon oi" data-glyph="info"></span>

                        <input class="form-control input-lg" type="text" name="amount" placeholder="Enter a value...">
                    </div>
                </div>

                <div class="col-lg-3 pt-2 pb-2">
                    <div class="input-group">
                        <span class="input-group-addon oi" data-glyph="flag"></span>

                        <select class="form-control" name="first">
                            <option selected>US Dollar (USD)</option>
                            <option>British Pound (GBP)</option>
                            <option>Euro (EUR)</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 pt-2 pb-2">
                    <div class="input-group">
                        <span class="input-group-addon oi" data-glyph="flag"></span>

                        <select class="form-control" name="second">
                            <option>US Dollar (USD)</option>
                            <option selected>British Pound (GBP)</option>
                            <option>Euro (EUR)</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 pt-2 pb-2">
                    <button type="submit" class="btn btn-block btn-dark">
                        Convert <span class="oi" data-glyph="arrow-right"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
