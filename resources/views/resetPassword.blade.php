<style>
    .error-list {
        color: red;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .error-list li {
        margin-bottom: 10px;
    }
    .form-container {
        width: 300px;
        margin: 50px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-container input[type="password"], .form-container input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .form-container input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }
    .form-container input[type="submit"]:hover {
        background-color: #3e8e41;
    }
</style>

@if($errors->any())
    <div class="error-list">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-container">
    <form method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$user[0]['id']}}">
        <input type="password" name="password" placeholder="New password">
        <br><br>
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <br><br>
        <input type="submit" value="Submit">
    </form>
</div>