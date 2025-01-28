<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mail Template</title>
</head>
<body>
    <h1>Your Account is created in My Application</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h4>Email :{{$email}}</h4>
                    <h4>Password:{{$password}}</h4>
                </div>
            </div>
        </div>
    </div>
</body>
</html>