<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>Currency Convertor</title>
</head>
<body>
    <div id="root" class="container">
        <div class="mt-4 p-3 bg-dark rounded text-white d-none" :class="{ 'd-block': success.display }">
            @{{ success.description }}
        </div>

        <div class="alert alert-danger mt-4 p-3 rounded d-none" :class="{ 'd-block': error.display }">
            @{{ error.description }}
        </div>

        <form @submit.prevent="calculate">
            <div class="row pt-4 pb-4">
                <div class="col-lg-3 pt-2 pb-2">
                    <div class="input-group">
                        <span class="input-group-addon oi" data-glyph="info"></span>

                        <input id="amount" class="form-control input-lg" type="text" name="amount" placeholder="Enter a value..."
                               v-model="amount" autofocus required>
                    </div>
                </div>

                <div class="col-lg-3 pt-2 pb-2">
                    <div class="input-group">
                        <span class="input-group-addon oi" data-glyph="flag"></span>

                        <select class="form-control" name="first" v-model="from">
                            <option value="USD" selected>US Dollar (USD)</option>
                            <option value="GBP">British Pound (GBP)</option>
                            <option value="EUR">Euro (EUR)</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 pt-2 pb-2">
                    <div class="input-group">
                        <span class="input-group-addon oi" data-glyph="flag"></span>

                        <select class="form-control" name="second" v-model="to">
                            <option value="USD" selected>US Dollar (USD)</option>
                            <option value="GBP">British Pound (GBP)</option>
                            <option value="EUR">Euro (EUR)</option>
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

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
