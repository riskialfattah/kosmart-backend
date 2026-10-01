<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Admin - KosMart</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #0f1115;
            color: white;
        }

        .login-container {
            width: 400px;
            padding: 40px;
            background: #181b21;
            border: 1px solid #2b3038;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo h1 {
            font-size: 36px;
            color: #ff3b30;
            letter-spacing: 2px;
        }

        .subtitle {
            text-align: center;
            color: #9ca3af;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #d1d5db;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #343943;
            border-radius: 8px;
            background: #111318;
            color: white;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #ff3b30;
        }

        .login-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #ff3b30;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-button:hover {
            background: #e52d24;
        }

        .error {
            background: #3a1717;
            border: 1px solid #7f1d1d;
            color: #fca5a5;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="logo">
        <h1>KOSMART</h1>
    </div>

    <div class="subtitle">
        Admin Panel
    </div>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/admin/login">
        @csrf

        <div class="form-group">
            <label for="email">Email Admin</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@kosmart.test"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
        </div>

        <button type="submit" class="login-button">
            LOGIN ADMIN
        </button>
    </form>

    <div class="footer">
        KosMart Admin Panel
    </div>

</div>

</body>
</html>