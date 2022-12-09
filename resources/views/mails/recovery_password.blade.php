<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Recuperar contraseña</title>

    <style>
        /* cyrillic-ext */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZJhiI2B.woff2) format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        /* cyrillic */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZthiI2B.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* greek-ext */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZNhiI2B.woff2) format('woff2');
            unicode-range: U+1F00-1FFF;
        }

        /* greek */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZxhiI2B.woff2) format('woff2');
            unicode-range: U+0370-03FF;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZBhiI2B.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZFhiI2B.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Inter';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/inter/v12/UcCO3FwrK3iLTeHuS_fvQtMwCp50KnMw2boKoduKmMEVuLyfAZ9hiA.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        .email_body {
            font-family: 'Inter';
            color: #214371;
            display: flex;
            justify-content: center
        }

        .card-email {
            margin-top: 2rem;
            border-radius: 25px;
            max-width: 700px;
            max-height: 700px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            padding: 1rem 3rem;
        }

        .w-90 {
            width: 100%;
            text-align: justify
        }

        .w-100 {
            width: 100%;
        }

        .align-centered-phone {
            display: flex;
            justify-content: center;
        }

        .button-home {
            background-color: #214371;
            color: white;
            border-radius: 30px;
            width: 200px;
            border: unset;
            padding: 10px 0;
            text-decoration: underline;
            font-size: 15px;
            font-weight: bold;
            font-family: 'Inter';
            text-align: center
        }


        .wrap-text {
            word-wrap: break-word;
            word-break: break-all;
        }

        .mtb-1rem{
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="email_body">
    <div class="card-email">
        <h3>
            Hola!
        </h3>
        <p class="w-90 wrap-text">Has solicitado una nueva contraseña. Para recuperarla, accede al siguiente sitio web y pon tu
            nueva contraseña:</p>

        <div class="w-100 align-centered-phone mtb-1rem">
            <a href='{{ $url }}' type="button" class="button-home"
                id="login-link-body">Recuperar contraseña</a>
        </div>

        <small class="w-90 wrap-text">Si no funciona ese botón en tu navegador, puedes acceder copiando el siguiente enlace: <br>
            {{ $url }}</small> 
    </div>

</body>

</html>
